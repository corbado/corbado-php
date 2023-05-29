<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Firebase\JWT\CachedKeySet;
use Firebase\JWT\JWT;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class ShortSession implements ShortSessionInterface
{

    private string $shortSessionCookieName;
    private string $issuer;
    private string $authorizedParty;
    private string $jwksURI;
    private ClientInterface $client;
    private CacheItemPoolInterface $jwksCachePool;

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function __construct(string $shortSessionCookieName, string $issuer, string $authorizedParty, string $jwksURI, ClientInterface $client, CacheItemPoolInterface $jwksCachePool)
    {
        Assert::stringNotEmpty($shortSessionCookieName);
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($authorizedParty);
        Assert::stringNotEmpty($jwksURI);

        $this->shortSessionCookieName = $shortSessionCookieName;
        $this->issuer = $issuer;
        $this->authorizedParty = $authorizedParty;
        $this->jwksURI = $jwksURI;
        $this->client = $client;
        $this->jwksCachePool = $jwksCachePool;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function getValue() : string
    {
        if (!empty($_COOKIE[$this->shortSessionCookieName])) {
            return $_COOKIE[$this->shortSessionCookieName];
        }

        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return $this->extractBearerToken($_SERVER['HTTP_AUTHORIZATION']);
        }

        return '';
    }

    public function validate(string $jwt) : ?stdClass
    {
        try {
            Assert::stringNotEmpty($jwt);

            $keySet = new CachedKeySet(
                $this->jwksURI,
                $this->client,
                new HttpFactory(),
                $this->jwksCachePool,
                null,
                true
            );

            // @phpstan-ignore-next-line
            $decoded = JWT::decode($jwt, $keySet);

            $issuerValid = false;
            if ($decoded->iss === $this->issuer) {
                $issuerValid = true;
            }

            $authorizedPartyValid = false;
            if ($decoded->azp === $this->authorizedParty) {
                $authorizedPartyValid = true;
            }

            if ($issuerValid === true && $authorizedPartyValid === true) {
                return $decoded;
            }

            return null;
        } catch (Throwable) {
            return null;
        }
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