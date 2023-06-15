<?php

namespace Corbado\Classes;

use Firebase\JWT\CachedKeySet;
use Firebase\JWT\JWT;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class Session
{
    private ClientInterface $client;
    private string $shortSessionCookieName;
    private string $issuer;
    private string $jwksURI;
    private CacheItemPoolInterface $jwksCachePool;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     * @param string $shortSessionCookieName
     * @param string $issuer
     * @param string $jwksURI
     * @param CacheItemPoolInterface $jwksCachePool
     * @throws Exceptions\Assert
     */
    public function __construct(ClientInterface $client, string $shortSessionCookieName, string $issuer, string $jwksURI, CacheItemPoolInterface $jwksCachePool)
    {
        Assert::stringNotEmpty($shortSessionCookieName);
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($jwksURI);

        $this->client = $client;
        $this->shortSessionCookieName = $shortSessionCookieName;
        $this->issuer = $issuer;
        $this->jwksURI = $jwksURI;
        $this->jwksCachePool = $jwksCachePool;
    }

    /**
     * Returns the short-term session (represented as JWT) value from the cookie or the Authorization header
     *
     * @return string
     * @throws Exceptions\Assert
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
     * @throws Exceptions\Assert
     */
    public function validateShortSessionValue(string $value) : ?stdClass
    {
        Assert::stringNotEmpty($value);

        try {
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
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * Returns current user from the short-term session
     *
     * If the user is not logged in, the user is marked as not
     * authenticated ("guest").
     *
     * @return User
     * @throws Exceptions\Assert
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
                $decoded->Name,
                $decoded->Email,
                $decoded->PhoneNumber
            );
        }

        return $guest;
    }

    /**
     * Extracts bearer token from authorization header
     *
     * @param string $authorizationHeader
     * @return string
     * @throws Exceptions\Assert
     */
    private function extractBearerToken(string $authorizationHeader) : string {
        Assert::stringNotEmpty($authorizationHeader);

        if (!str_starts_with($authorizationHeader, 'Bearer ')) {
            return '';
        }

        return substr($authorizationHeader, 7);
    }
}
