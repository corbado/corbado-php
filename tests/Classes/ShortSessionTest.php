<?php

use Corbado\Classes\ShortSession;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class ShortSessionTest extends TestCase {
    /**
     * @dataProvider provideJWTs
     */
    public function testValidate($expected, $input) : void
    {
        $mock = new MockHandler(
            [
                new Response(200, [], file_get_contents(dirname(__FILE__) . '/testdata/jwks.json'))
            ]
        );

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $shortSession = new ShortSession(
            'https://auth.acme.com',
            'https://www.acme.com',
            'https://xxx', // does not matter because response is mocked
            $client,
            new ArrayAdapter()
        );

        $result = $shortSession->validate($input);
        $this->assertEquals($expected, $result);
    }

    /**
     * @throws Exception
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
                self::generateJWT('https://auth.acme.com', 'https://www.acme.com', time()+100, time()+100)
            ],
            [
                // Expired (exp)
                false,
                self::generateJWT('https://auth.acme.com', 'https://www.acme.com', time()-100, time()-100)
            ],
            [
                // Invalid issuer (iss)
                false,
                self::generateJWT('https://invalid.com', 'https://www.acme.com', time()+100, time()-100)
            ],
            [
                // Invalid authorized party (azp)
                false,
                self::generateJWT('https://auth.acme.com', 'https://invalid.com', time()+100, time()-100)
            ],
            [
                // Success
                true,
                self::generateJWT('https://auth.acme.com', 'https://www.acme.com', time()+100, time()-100)
            ]
        ];
    }

    /**
     * @throws Exception
     */
    private static function generateJWT(string $iss, string $azp, int $exp, int $nbf) : string
    {
        $payload = [
            'iss' => $iss,
            'azp' => $azp,
            'iat' => time(),
            'exp' => $exp,
            'nbf' => $nbf
        ];

        $privateKey = file_get_contents(dirname(__FILE__) . '/testdata/privateKey.pem');
        if ($privateKey === false) {
            throw new Exception('file_get_contents() failed');
        }

        return JWT::encode($payload, $privateKey, 'RS256', 'kid123');
    }
}