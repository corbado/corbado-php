<?php

namespace unit\Services;

use Corbado\Exceptions\ValidationException;
use Corbado\Exceptions\AssertException;
use Corbado\Services\SessionService;
use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class SessionServiceTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws Exception
     */
    public function testGetShortSessionValue(): void
    {
        $session = self::createSession();

        $_COOKIE['cbo_short_session'] = 'cookie_1234567890';
        $_SERVER['HTTP_AUTHORIZATION'] = 'Bearer bearer_1234567890';

        // Check for cookie (has priority)
        $value = $session->getShortSessionValue();
        $this->assertEquals('cookie_1234567890', $value);

        // Check for header
        unset($_COOKIE['cbo_short_session']);
        $value = $session->getShortSessionValue();
        $this->assertEquals('bearer_1234567890', $value);

        // Cleanup so other tests are not affected
        unset($_SERVER['HTTP_AUTHORIZATION']);
    }

    /**
     * @dataProvider provideJWTs
     * @throws Exception
     */
    public function testValidateShortSessionValue(bool $success, string $value): void
    {
        if (!$success) {
            $this->expectException(ValidationException::class);
        }

        $session = self::createSession();
        $value = $session->validateShortSessionValue($value);
        $this->assertTrue($value instanceof \stdClass);
    }

    /**
     * @throws Exception
     * @return array<int, array<int, bool|string>>
     */
    public static function provideJWTs(): array
    {
        return [
            [
                // JWT with invalid format
                false,
                'invalid'
            ],
            [
                // JWT signed with wrong algorithm (HS256 instead of RS256)
                false,
                'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWV9.dyt0CoTl4WoVjAHI9Q_CwSKhl6d_9rhM3NrXuJttkao'
            ],
            [
                // Not before (nfb) in future
                false,
                self::generateJWT('https://auth.acme.com', time() + 100, time() + 100)
            ],
            [
                // Expired (exp)
                false,
                self::generateJWT('https://auth.acme.com', time() - 100, time() - 100)
            ],
            [
                // Invalid issuer (iss)
                false,
                self::generateJWT('https://invalid.com', time() + 100, time() - 100)
            ],
            [
                // Success
                true,
                self::generateJWT('https://auth.acme.com', time() + 100, time() - 100)
            ]
        ];
    }

    /**
     * @throws Exception
     */
    public function testGetCurrentUserGuest(): void
    {
        $session = self::createSession();
        $user = $session->getCurrentUser();
        $this->assertFalse($user->isAuthenticated());
    }

    /**
     * @throws Exception
     */
    public function testGetCurrentUserAuthenticated(): void
    {
        $_COOKIE['cbo_short_session'] = self::generateJWT('https://auth.acme.com', time() + 100, time() - 100);

        $session = self::createSession();
        $user = $session->getCurrentUser();
        $this->assertTrue($user->isAuthenticated());
        $this->assertEquals('name', $user->getName());
        $this->assertEquals('email', $user->getEmail());
        $this->assertEquals('orig', $user->getOrig());
    }

    /**
     * @throws Exception
     */
    private static function createSession(): SessionService
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

                    public function expiresAt(?\DateTimeInterface $expiration): static
                    {
                        return $this;
                    }

                    public function expiresAfter(\DateInterval|int|null $time): static
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
            'cbo_short_session',
            'https://auth.acme.com',
            'https://xxx', // does not matter because response is mocked
            $cacheItemPool
        );
    }

    /**
     * @throws Exception
     */
    private static function generateJWT(string $iss, int $exp, int $nbf): string
    {
        $payload = [
            'iss' => $iss,
            'iat' => time(),
            'exp' => $exp,
            'nbf' => $nbf,
            'sub' => '12345',
            'name' => 'name',
            'email' => 'email',
            'phone_number' => 'phoneNumber',
            'orig' => 'orig',
        ];

        $privateKey = file_get_contents(dirname(__FILE__) . '/testdata/privateKey.pem');
        if ($privateKey === false) {
            throw new Exception('file_get_contents() failed');
        }

        return JWT::encode($payload, $privateKey, 'RS256', 'kid123');
    }
}
