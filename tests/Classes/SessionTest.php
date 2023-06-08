<?php

namespace Classes;

use Corbado\Classes\Exceptions\Assert;
use Corbado\Classes\Session;
use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class SessionTest extends TestCase
{
    /**
     * @throws Assert
     * @throws Exception
     */
    public function testGetShortSessionValue() : void
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
    }

    /**
     * @dataProvider provideJWTs
     * @throws Exception
     */
    public function testValidateShortSessionValue(bool $expected, string $value): void
    {
        $session = self::createSession();
        $result = $session->validateShortSessionValue($value);
        $this->assertEquals($expected, $result !== null);
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
                self::generateJWT('https://auth.acme.com',  time() + 100, time() + 100)
            ],
            [
                // Expired (exp)
                false,
                self::generateJWT('https://auth.acme.com',  time() - 100, time() - 100)
            ],
            [
                // Invalid issuer (iss)
                false,
                self::generateJWT('https://invalid.com',  time() + 100, time() - 100)
            ],
            [
                // Success
                true,
                self::generateJWT('https://auth.acme.com',  time() + 100, time() - 100)
            ]
        ];
    }

    /**
     * @throws Exception
     */
    public function testGetCurrentUseGuest() : void
    {
        $session = self::createSession();
        $user = $session->getCurrentUser();
        $this->assertFalse($user->isAuthenticated());
    }

    /**
     * @throws Exception
     */
    public function testGetCurrentUseAuthenticated() : void
    {
        $_COOKIE['cbo_short_session'] = self::generateJWT('https://auth.acme.com', time() + 100, time() - 100);

        $session = self::createSession();
        $user = $session->getCurrentUser();
        $this->assertTrue($user->isAuthenticated());
    }

    /**
     * @throws Exception
     */
    private static function createSession() : Session
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

        $cacheItem = new class implements CacheItemInterface {
            public function getKey(): string
            {
                return '';
            }

            public function get(): mixed
            {
                return null;
            }

            public function isHit(): bool
            {
                return false;
            }

            public function set(mixed $value): static
            {
                return new static();
            }

            public function expiresAt(?\DateTimeInterface $expiration): static
            {
                // TODO: Implement expiresAt() method.
            }

            public function expiresAfter(\DateInterval|int|null $time): static
            {
                // TODO: Implement expiresAfter() method.
            }
        }

        $cacheItemPool = new class implements CacheItemPoolInterface {
            public function getItem(string $key): CacheItemInterface
            {
                return new $cacheItem();
            }

            public function getItems(array $keys = []): iterable
            {
                // TODO: Implement getItems() method.
            }

            public function hasItem(string $key): bool
            {
                // TODO: Implement hasItem() method.
            }

            public function clear(): bool
            {
                // TODO: Implement clear() method.
            }

            public function deleteItem(string $key): bool
            {
                // TODO: Implement deleteItem() method.
            }

            public function deleteItems(array $keys): bool
            {
                // TODO: Implement deleteItems() method.
            }

            public function save(CacheItemInterface $item): bool
            {
                // TODO: Implement save() method.
            }

            public function saveDeferred(CacheItemInterface $item): bool
            {
                // TODO: Implement saveDeferred() method.
            }

            public function commit(): bool
            {
                // TODO: Implement commit() method.
            }
        }

        return new Session(
            'v2',
            'cbo_short_session',
            'https://auth.acme.com',
            'https://xxx', // does not matter because response is mocked
            $client,
            new ArrayAdapter()
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
            'phoneNumber' => 'phoneNumber'
        ];

        $privateKey = file_get_contents(dirname(__FILE__) . '/testdata/privateKey.pem');
        if ($privateKey === false) {
            throw new Exception('file_get_contents() failed');
        }

        return JWT::encode($payload, $privateKey, 'RS256', 'kid123');
    }
}
