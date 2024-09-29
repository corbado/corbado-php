<?php

namespace unit\Services;

use Corbado\Exceptions\ValidationException;
use Corbado\Exceptions\AssertException;
use Corbado\Services\SessionService;
use DateInterval;
use DateTimeInterface;
use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Throwable;

class SessionServiceTest extends TestCase
{
    /**
     * @dataProvider provideJWTs
     * @throws Exception
     */
    public function testValidateToken(string $issuer, string $shortSession, bool $success, int $code): void
    {
        $exception = null;
        $user = null;

        try {
            $session = self::createSession($issuer);
            $user = $session->validateToken($shortSession);
        } catch (Throwable $e) {
            $exception = $e;
        }

        if ($success === true) {
            $this->assertNotNull($user);
            $this->assertEquals('usr-1234567890', $user->getID());
        } else {
            $this->assertInstanceOf(ValidationException::class, $exception);
            $this->assertEquals($code, $exception->getCode());
        }
    }

    /**
     * @return array<int, array<int, string|bool|int>>
     * @throws Exception
     */
    public static function provideJWTs(): array
    {

        $privateKey = file_get_contents(dirname(__FILE__) . '/testdata/validPrivateKey.pem');
        if ($privateKey === false) {
            throw new Exception('file_get_contents() failed');
        }

        $invalidPrivateKey = file_get_contents(dirname(__FILE__) . '/testdata/invalidPrivateKey.pem');
        if ($invalidPrivateKey === false) {
            throw new Exception('file_get_contents() failed');
        }

        return [
            [
                // JWT with invalid format
                'https://pro-1.frontendapi.cloud.corbado.io',
                'invalid',
                false,
                ValidationException::CODE_JWT_INVALID_DATA
            ],
            [
                // JWT with invalid signature
                'https://pro-1.frontendapi.cloud.corbado.io',
                'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6ImtpZDEyMyJ9.eyJpc3MiOiJodHRwczovL2F1dGguYWNtZS5jb20iLCJpYXQiOjE3MjY0OTE4MDcsImV4cCI6MTcyNjQ5MTkwNywibmJmIjoxNzI2NDkxNzA3LCJzdWIiOiJ1c3ItMTIzNDU2Nzg5MCIsIm5hbWUiOiJuYW1lIiwiZW1haWwiOiJlbWFpbCIsInBob25lX251bWJlciI6InBob25lTnVtYmVyIiwib3JpZyI6Im9yaWcifQ.invalid',
                false,
                ValidationException::CODE_JWT_INVALID_SIGNATURE
            ],
            [
                // JWT with invalid private key signed
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-1.frontendapi.cloud.corbado.io', time() + 100, time() + 100, $invalidPrivateKey),
                false,
                ValidationException::CODE_JWT_INVALID_SIGNATURE
            ],
            [
                // Not before (nfb) in future
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-1.frontendapi.cloud.corbado.io', time() + 100, time() + 100, $privateKey),
                false,
                ValidationException::CODE_JWT_BEFORE
            ],
            [
                // Expired (exp)
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-1.frontendapi.cloud.corbado.io', time() - 100, time() - 100, $privateKey),
                false,
                ValidationException::CODE_JWT_EXPIRED
            ],
            [
                // Invalid issuer (iss)
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-2.frontendapi.cloud.corbado.io', time() + 100, time() - 100, $privateKey),
                false,
                ValidationException::CODE_JWT_ISSUER_MISMATCH
            ],
            [
                // Invalid issuer (iss)
                'https://pro-1.frontendapi.corbado.io',
                self::generateJWT('https://pro-2.frontendapi.cloud.corbado.io', time() + 100, time() - 100, $privateKey),
                false,
                ValidationException::CODE_JWT_ISSUER_MISMATCH
            ],
            [
                // Invalid issuer (iss)
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-2.frontendapi.corbado.io', time() + 100, time() - 100, $privateKey),
                false,
                ValidationException::CODE_JWT_ISSUER_MISMATCH
            ],
            [
                // Success with new Frontend API URL
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-1.frontendapi.cloud.corbado.io', time() + 100, time() - 100, $privateKey),
                true,
                0
            ],
            [
                // Success with old Frontend API URL in JWT
                'https://pro-1.frontendapi.cloud.corbado.io',
                self::generateJWT('https://pro-1.frontendapi.corbado.io', time() + 100, time() - 100, $privateKey),
                true,
                0
            ],
            [
                // Success with old Frontend API URL in config
                'https://pro-1.frontendapi.corbado.io',
                self::generateJWT('https://pro-1.frontendapi.cloud.corbado.io', time() + 100, time() - 100, $privateKey),
                true,
                0
            ],
            [
                // Success with CNAME
                'https://auth.acme.com',
                self::generateJWT('https://auth.acme.com', time() + 100, time() - 100, $privateKey),
                true,
                0
            ]
        ];
    }

    /**
     * @throws Exception
     */
    private static function createSession(string $issuer): SessionService
    {
        $jwks = file_get_contents(dirname(__FILE__) . '/testdata/jwks.json');
        if ($jwks === false) {
            throw new Exception('file_get_contents() failed');
        }

        $mock = new MockHandler(
            [
                new Response(200, [], $jwks)
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $cacheItemPool = new class () implements CacheItemPoolInterface {
            /**
             * @var array <string, CacheItemInterface>
             */
            private array $items = [];

            public function getItem(string $key): CacheItemInterface
            {
                if (array_key_exists($key, $this->items)) {
                    return $this->items[$key];
                }

                return new class ($key) implements CacheItemInterface {
                    private string $key;
                    private mixed $value;
                    private bool $isHit;

                    public function __construct(string $key)
                    {
                        $this->key = $key;
                        $this->value = null;
                        $this->isHit = false;
                    }

                    public function getKey(): string
                    {
                        return $this->key;
                    }

                    public function get(): mixed
                    {
                        return $this->value;
                    }

                    public function isHit(): bool
                    {
                        return $this->isHit;
                    }

                    public function set(mixed $value): static
                    {
                        $this->value = $value;
                        $this->isHit = true;

                        return $this;
                    }

                    public function expiresAt(?DateTimeInterface $expiration): static
                    {
                        return $this;
                    }

                    public function expiresAfter(DateInterval|int|null $time): static
                    {
                        return $this;
                    }
                };
            }

            /**
             * @param array<int, string> $keys
             * @return iterable<string, CacheItemInterface>
             */
            public function getItems(array $keys = []): iterable
            {
                return $this->items;
            }

            public function hasItem(string $key): bool
            {
                return array_key_exists($key, $this->items);
            }

            public function clear(): bool
            {
                $this->items = [];

                return true;
            }

            public function deleteItem(string $key): bool
            {
                unset($this->items[$key]);

                return true;
            }

            public function deleteItems(array $keys): bool
            {
                foreach ($keys as $key) {
                    $this->deleteItem($key);
                }

                return true;
            }

            public function save(CacheItemInterface $item): bool
            {
                $this->items[$item->getKey()] = $item;

                return true;
            }

            public function saveDeferred(CacheItemInterface $item): bool
            {
                $this->save($item);

                return true;
            }

            public function commit(): bool
            {
                return true;
            }
        };

        return new SessionService(
            $client,
            $issuer,
            'https://xxx', // does not matter because response is mocked
            $cacheItemPool,
            'pro-1'
        );
    }

    /**
     * @throws Exception
     */
    private static function generateJWT(string $iss, int $exp, int $nbf, string $privateKey): string
    {
        $payload = [
            'iss' => $iss,
            'iat' => time(),
            'exp' => $exp,
            'nbf' => $nbf,
            'sub' => 'usr-1234567890',
            'name' => 'name',
            'email' => 'email',
            'phone_number' => 'phoneNumber',
            'orig' => 'orig',
        ];

        return JWT::encode($payload, $privateKey, 'RS256', 'kid123');
    }
}
