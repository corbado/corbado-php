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
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class SessionTest extends TestCase
{
    /**
     * @throws Assert
     */
    public function testGetShortSessionValue() : void
    {
        $client = new Client();
        $session = new Session(
            'cbo_short_session',
            'https://auth.acme.com',
            'https://xxx', // does not matter because response is mocked
            $client,
            new ArrayAdapter()
        );

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
     * @throws Assert
     */
    public function testValidateShortSessionValue(bool $expected, string $value): void
    {
        $jwks = file_get_contents(dirname(__FILE__) . '/testdata/jwks.json');
        $this->assertNotFalse($jwks);

        $mock = new MockHandler(
            [
                new Response(200, [], $jwks)
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $session = new Session(
            'cbo_short_session',
            'https://auth.acme.com',
            'https://xxx', // does not matter because response is mocked
            $client,
            new ArrayAdapter()
        );

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
    private static function generateJWT(string $iss, int $exp, int $nbf): string
    {
        $payload = [
            'iss' => $iss,
            'iat' => time(),
            'exp' => $exp,
            'nbf' => $nbf,
            'sub' => '12345',
        ];

        $privateKey = file_get_contents(dirname(__FILE__) . '/testdata/privateKey.pem');
        if ($privateKey === false) {
            throw new Exception('file_get_contents() failed');
        }

        return JWT::encode($payload, $privateKey, 'RS256', 'kid123');
    }
}
