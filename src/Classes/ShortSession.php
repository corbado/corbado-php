<?php

namespace Corbado\Classes;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Cache\CacheItemPoolInterface;

class ShortSession
{
    private CacheItemPoolInterface $jwksCachePool;

    public function __construct(CacheItemPoolInterface $jwksCachePool)
    {
        $this->jwksCachePool = $jwksCachePool;
    }

    /**
     * @throws \Corbado\Exceptions\Assert
     */
    public function validate(string $jwt) : bool
    {
        Assert::stringNotEmpty($jwt);

        $key = 'example_key';
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($payload, $key, 'HS256');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

        print_r($decoded);

        return false;
    }

}