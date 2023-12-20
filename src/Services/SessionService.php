<?php

namespace Corbado\Services;

use Corbado\Entities\UserEntity;
use Corbado\Exceptions\AssertException;
use Corbado\Helper\Assert;
use Firebase\JWT\CachedKeySet;
use Firebase\JWT\JWT;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class SessionService implements SessionInterface
{
    private ClientInterface $client;
    private string $shortSessionCookieName;
    private string $issuer;
    private string $jwksURI;
    private CacheItemPoolInterface $jwksCachePool;
    private string $lastShortSessionValidationResult = '';

    /**
     * Constructor
     *
     * @param ClientInterface $client
     * @param string $shortSessionCookieName
     * @param string $issuer
     * @param string $jwksURI
     * @param CacheItemPoolInterface $jwksCachePool
     * @throws AssertException
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
     * @throws AssertException
     */
    public function getShortSessionValue(): string
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
     * @return stdClass|null Returns stdClass on success, otherwise null
     * @throws AssertException
     */
    public function validateShortSessionValue(string $value): ?stdClass
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
            } else {
                $this->lastShortSessionValidationResult = sprintf('Mismatch in issuer (configured through FrontendAPI: "%s", JWT: "%s")', $this->issuer, $decoded->iss);
            }

            if ($issuerValid === true) {
                return $decoded;
            }

            return null;
        } catch (Throwable $e) {
            $this->lastShortSessionValidationResult = sprintf('JWT validation failed: "%s"', $e->getMessage());
            return null;
        }
    }

    /**
     * Returns the last short-term session validation result
     *
     * This method returns the exact reason why the last validation
     * failed (for example expired or issuer mismatch).
     *
     * @return string
     */
    public function getLastShortSessionValidationResult(): string
    {
        return $this->lastShortSessionValidationResult;
    }

    /**
     * Returns current user from the short-term session
     *
     * If the user is not logged in, the user is marked as not
     * authenticated ("guest").
     *
     * @return UserEntity
     * @throws AssertException
     */
    public function getCurrentUser(): UserEntity
    {
        $guest = new UserEntity(false);

        $value = $this->getShortSessionValue();
        if (strlen($value) < 10) {
            return $guest;
        }

        $decoded = $this->validateShortSessionValue($value);
        if ($decoded !== null) {
            $name = '';
            if (isset($decoded->name)) {
                $name = $decoded->name;
            }

            $email = '';
            if (isset($decoded->email)) {
                $email = $decoded->email;
            }

            $phoneNumber = '';
            if (isset($decoded->phone_number)) {
                $phoneNumber = $decoded->phone_number;
            }

            return new UserEntity(
                true,
                $decoded->sub,
                $name,
                $email,
                $phoneNumber
            );
        }

        return $guest;
    }

    /**
     * Extracts bearer token from authorization header
     *
     * @param string $authorizationHeader
     * @return string
     * @throws AssertException
     */
    private function extractBearerToken(string $authorizationHeader): string
    {
        Assert::stringNotEmpty($authorizationHeader);

        if (!str_starts_with($authorizationHeader, 'Bearer ')) {
            return '';
        }

        return substr($authorizationHeader, 7);
    }
}
