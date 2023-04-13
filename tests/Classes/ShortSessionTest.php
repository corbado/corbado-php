<?php

use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;

class ShortSessionTest extends TestCase {
    /**
     * @dataProvider provideJWTs
     */
    public function testVerify($expected, $input) : void
    {
        $this->assertEquals($expected, $input);
    }

    /**
     * @throws Exception
     */
    public static function provideJWTs(): array
    {
        return [
            [
              // Not before (nfb) in future
              false,
              self::generateJWT("https://auth.acme.com", "https://www.acme.com", time()+100, time()+100)
            ],
            [
                // Expired (exp)
                false,
                self::generateJWT("https://auth.acme.com", "https://www.acme.com", time()-100, time()-100)
            ],
            [
                // Invalid issuer (iss)
                false,
                self::generateJWT("https://invalid.com", "https://www.acme.com", time()+100, time()-100)
            ],
            [
                // Invalid authorized party (azp)
                false,
                self::generateJWT("https://auth.acme.com", "https://invalid.com", time()+100, time()-100)
            ],
            [
                // Success
                true,
                self::generateJWT("https://auth.acme.com", "https://www.acme.com", time()+100, time()-100)
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
