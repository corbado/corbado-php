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

class ShortSession
{

    private string $issuer;
    private string $authorizedParty;
    private string $jwksURI;
    private ClientInterface $client;
    private CacheItemPoolInterface $jwksCachePool;

    /**
     * @throws \Corbado\Exceptions\Assert
     */
    public function __construct(string $issuer, string $authorizedParty, string $jwksURI, ClientInterface $client, CacheItemPoolInterface $jwksCachePool)
    {
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($authorizedParty);
        Assert::stringNotEmpty($jwksURI);

        $this->issuer = $issuer;
        $this->authorizedParty = $authorizedParty;
        $this->jwksURI = $jwksURI;
        $this->client = $client;
        $this->jwksCachePool = $jwksCachePool;
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
}