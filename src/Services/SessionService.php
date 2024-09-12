<?php

namespace Corbado\Services;

use Corbado\Entities\UserEntity;
use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ValidationException;
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
     * @return stdClass Returns stdClass
     * @throws AssertException|ValidationException
     */
    public function validateShortSessionValue(string $value): stdClass
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
            if ($decoded->iss !== $this->issuer) { // @todo Add unit test for this case
                throw new ValidationException('Mismatch in JWT issuer (configured through FrontendAPI: "%s", JWT issuer: "%s")', ValidationException::CODE_JWT_ISSUER_MISMATCH);
            }

            return $decoded;
        } catch (Throwable $e) {
            throw new ValidationException(sprintf('JWT validation failed: "%s %s"', $e->getMessage(), $value), ValidationException::CODE_GENERAL);
        }
    }

    /**
     * Returns current user from the short-term session
     *
     * If the user is not logged in, the user is marked as not
     * authenticated ("guest").
     *
     * @return UserEntity
     * @throws AssertException
     * @throws ValidationException
     */
    public function getCurrentUser(): UserEntity
    {
        $guest = new UserEntity(false);

        $value = $this->getShortSessionValue();
        if (strlen($value) < 10) {
            return $guest;
        }

        $decoded = $this->validateShortSessionValue($value);
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

        $orig = '';
        if (isset($decoded->orig)) {
            $orig = $decoded->orig;
        }

        return new UserEntity(
            true,
            $decoded->sub,
            $name,
            $email,
            $phoneNumber,
            $orig
        );
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
