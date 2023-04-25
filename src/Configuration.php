<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

class Configuration {
    private string $baseURI = 'https://api.corbado.com/v1';
    private string $projectID;
    private string $apiSecret;
    private string $shortSessionCookieName = 'cbo_short_session';
    private ?ClientInterface $httpClient = null;
    private ?CacheItemPoolInterface $jwksCachePool = null;

    /**
     * @throws Exceptions\Assert
     */
    public function setBaseURI(string $baseURI) : self
    {
        Assert::stringNotEmpty($baseURI);

        $this->baseURI = $baseURI;

        return $this;
    }

    /**
     * @throws Exceptions\Assert
     * @throws Exceptions\Configuration
     */
    public function setProjectID(string $projectID) : self
    {
        Assert::stringNotEmpty($projectID);

        if (!str_starts_with($projectID, 'pro-')) {
            throw new Exceptions\Configuration('Invalid project ID "' . $projectID . '" given, needs to start with "pro-"');
        }

        $this->projectID = $projectID;

        return $this;
    }

    /**
     * @throws Exceptions\Assert
     */
    public function setApiSecret(string $apiSecret) : self
    {
        Assert::stringNotEmpty($apiSecret);

        $this->apiSecret = $apiSecret;

        return $this;
    }

    public function setShortSessionCookieName(string $shortSessionCookieName) : self
    {
        Assert::stringNotEmpty($shortSessionCookieName);

        $this->shortSessionCookieName = $shortSessionCookieName;

        return $this;
    }

    public function setHttpClient(ClientInterface $httpClient) : self {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setJwksCachePool(CacheItemPoolInterface $jwksCachePool) : self
    {
        $this->jwksCachePool = $jwksCachePool;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseURI(): string
    {
        return $this->baseURI;
    }

    /**
     * @return string
     */
    public function getProjectID(): string
    {
        return $this->projectID;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    /**
     * @return string
     */
    public function getShortSessionCookieName() : string
    {
        return $this->shortSessionCookieName;
    }

    /**
     * @return ClientInterface|null
     */
    public function getHttpClient(): ?ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return CacheItemPoolInterface|null
     */
    public function getJwksCachePool(): ?CacheItemPoolInterface
    {
        return $this->jwksCachePool;
    }
}