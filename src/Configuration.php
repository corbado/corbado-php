<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

class Configuration {
    private string $projectID = '';
    private string $apiSecret = '';
    private string $frontendAPI = '';
    private string $backendAPI = 'https://backendapi.corbado.io';
    private string $shortSessionCookieName = 'cbo_short_session';
    private ?ClientInterface $httpClient = null;
    private ?CacheItemPoolInterface $jwksCachePool = null;

    /**
     * @throws Classes\Exceptions\Assert
     * @throws Classes\Exceptions\Configuration
     */
    public function setProjectID(string $projectID) : self
    {
        Assert::stringNotEmpty($projectID);

        if (!str_starts_with($projectID, 'pro-')) {
            throw new Classes\Exceptions\Configuration('Invalid project ID "' . $projectID . '" given, needs to start with "pro-"');
        }

        $this->projectID = $projectID;

        return $this;
    }

    /**
     * @throws Classes\Exceptions\Assert
     */
    public function setApiSecret(string $apiSecret) : self
    {
        Assert::stringNotEmpty($apiSecret);

        $this->apiSecret = $apiSecret;

        return $this;
    }

    public function setFrontendAPI(string $frontendAPI) : self
    {
        $this->assertURL($frontendAPI);

        $this->frontendAPI = $frontendAPI;

        return $this;
    }

    public function setBackendAPI(string $backendAPI) : self
    {
        $this->assertURL($backendAPI);

        $this->backendAPI = $backendAPI;

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

    public function getFrontendAPI() : string
    {
        if ($this->frontendAPI === '') {
            if ($this->projectID === '') {
                throw new Classes\Exceptions\Configuration('ProjectID empty, use setProjectID() first');
            }

            $this->frontendAPI = 'https://' . $this->projectID . '.frontendapi.corbado.io';
        }

        return $this->frontendAPI;
    }

    public function getBackendAPI() : string
    {
        return $this->backendAPI;
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

    /**
     * @throws Classes\Exceptions\Assert
     */
    private function assertURL(string $url) : void
    {
        Assert::stringNotEmpty($url);

        $parts = parse_url($url);
        if ($parts === false) {
            throw new Classes\Exceptions\Assert('Assert failed: parse_url() returned error');
        }

        if (isset($parts['scheme']) && $parts['scheme'] !== 'https') {
            throw new Classes\Exceptions\Assert('Assert failed: scheme needs to be https');
        }

        if (!isset($parts['host'])) {
            throw new Classes\Exceptions\Assert('Assert failed: host is empty');
        }

        if (isset($parts['user'])) {
            throw new Classes\Exceptions\Assert('Assert failed: username needs to be empty');
        }

        if (isset($parts['pass'])) {
            throw new Classes\Exceptions\Assert('Assert failed: password needs to be empty');
        }

        if (isset($parts['path'])) {
            throw new Classes\Exceptions\Assert('Assert failed: path needs to be empty');
        }

        if (isset($parts['query'])) {
            throw new Classes\Exceptions\Assert('Assert failed: querystring needs to be empty');
        }

        if (isset($parts['fragment'])) {
            throw new Classes\Exceptions\Assert('Assert failed: fragment needs to be empty');
        }
    }
}