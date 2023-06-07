<?php

namespace Corbado\Classes;

use Firebase\JWT\CachedKeySet;
use Firebase\JWT\JWT;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class Session implements SessionInterface
{

    private string $shortSessionCookieName;
    private string $issuer;
    private string $jwksURI;
    private ClientInterface $client;
    private CacheItemPoolInterface $jwksCachePool;

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function __construct(string $shortSessionCookieName, string $issuer, string $jwksURI, ClientInterface $client, CacheItemPoolInterface $jwksCachePool)
    {
        Assert::stringNotEmpty($shortSessionCookieName);
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($jwksURI);

        $this->shortSessionCookieName = $shortSessionCookieName;
        $this->issuer = $issuer;
        $this->jwksURI = $jwksURI;
        $this->client = $client;
        $this->jwksCachePool = $jwksCachePool;
    }

    /**
     * Returns the short-term session (represented as JWT) value from the cookie or the Authorization header
     *
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function getShortSessionValue() : string
    {
        if (!empty($_COOKIE[$this->shortSessionCookieName])) {
            return $_COOKIE[$this->shortSessionCookieName];
        }

        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return $this->extractBearerToken($_SERVER['HTTP_AUTHORIZATION']);
        }

        return '';
    }

    /**
     * Validates the given short-term session (represented as JWT) value
     *
     * @param string $value Value (JWT)
     * @return stdClass|null
     */
    public function validateShortSessionValue(string $value) : ?stdClass
    {
        try {
            Assert::stringNotEmpty($value);

            $keySet = new CachedKeySet(
                $this->jwksURI,
                $this->client,
                new HttpFactory(),
                $this->jwksCachePool,
                null,
                true
            );

            $decoded = JWT::decode($value, $keySet);

            $issuerValid = false;
            if ($decoded->iss === $this->issuer) {
                $issuerValid = true;
            }

            if ($issuerValid === true) {
                return $decoded;
            }

            return null;
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     */
    public function getCurrentUser() : User
    {
        $guest = new User(false);

        $value = $this->getShortSessionValue();
        if (strlen($value) < 10) {
            return $guest;
        }

        $decoded = $this->validateShortSessionValue($value);
        if ($decoded !== null) {
            return new User(
                true,
                $decoded->sub,
                $decoded->name,
                $decoded->email,
                $decoded->phoneNumber
            );
        }

        return $guest;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    private function extractBearerToken(string $authorizationHeader) : string {
        Assert::stringNotEmpty($authorizationHeader);

        if (!str_starts_with($authorizationHeader, 'Bearer ')) {
            return '';
        }

        return substr($authorizationHeader, 7);
    }
}