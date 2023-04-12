<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

class Configuration {
    private string $baseURI = 'https://api.corbado.com/v1';
    private string $projectID;
    private string $apiSecret;
    private ?ClientInterface $httpClient = null;
    private ?CacheItemPoolInterface $jwksCachePool = null;

    /**
     * @throws Exceptions\Assert
     */
    public function setBaseURI(string $baseURI) : Configuration
    {
        Assert::stringNotEmpty($baseURI);

        $this->baseURI = $baseURI;

        return $this;
    }

    /**
     * @throws Exceptions\Assert
     * @throws Exceptions\Configuration
     */
    public function setProjectID(string $projectID) : Configuration
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
    public function setApiSecret(string $apiSecret) : Configuration
    {
        Assert::stringNotEmpty($apiSecret);

        $this->apiSecret = $apiSecret;

        return $this;
    }

    public function setHttpClient(ClientInterface $httpClient) : Configuration {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setJwksCachePool(CacheItemPoolInterface $jwksCachePool) : Configuration
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