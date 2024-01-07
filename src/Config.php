<?php

namespace Corbado;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Helper\Assert;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

class Config
{
    private string $projectID = '';
    private string $apiSecret = '';
    private string $frontendAPI = '';
    private string $backendAPI = 'https://backendapi.corbado.io';
    private string $shortSessionCookieName = 'cbo_short_session';
    private ?ClientInterface $httpClient = null;
    private ?CacheItemPoolInterface $jwksCachePool = null;

    /**
     * Constructor
     *
     * Since project ID and API secret are always needed they are
     * passed via the constructor. All other options can be set via
     * setters.
     *
     * @throws AssertException
     * @throws ConfigException
     */
    public function __construct(string $projectID, string $apiSecret = '')
    {
        Assert::stringNotEmpty($projectID);

        if (!str_starts_with($projectID, 'pro-')) {
            throw new Exceptions\ConfigException('Invalid project ID "' . $projectID . '" given, needs to start with "pro-"');
        }

        if ($apiSecret !== '' && !str_starts_with($apiSecret, 'corbado1_')) {
            throw new Exceptions\ConfigException('Invalid API secret "' . $apiSecret . '" given, needs to start with "corbado1_"');
        }

        $this->projectID = $projectID;
        $this->apiSecret = $apiSecret;
    }

    /**
     * @throws AssertException
     */
    public function setFrontendAPI(string $frontendAPI): self
    {
        $this->assertURL($frontendAPI);

        $this->frontendAPI = $frontendAPI;

        return $this;
    }

    /**
     * @throws AssertException
     */
    public function setBackendAPI(string $backendAPI): self
    {
        $this->assertURL($backendAPI);

        $this->backendAPI = $backendAPI;

        return $this;
    }

    /**
     * @throws AssertException
     */
    public function setShortSessionCookieName(string $shortSessionCookieName): self
    {
        Assert::stringNotEmpty($shortSessionCookieName);

        $this->shortSessionCookieName = $shortSessionCookieName;

        return $this;
    }

    public function setHttpClient(ClientInterface $httpClient): self
    {
        $this->httpClient = $httpClient;

        return $this;
    }

    public function setJwksCachePool(CacheItemPoolInterface $jwksCachePool): self
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

    public function getFrontendAPI(): string
    {
        if ($this->frontendAPI === '') {
            $this->frontendAPI = 'https://' . $this->projectID . '.frontendapi.corbado.io';
        }

        return $this->frontendAPI;
    }

    public function getBackendAPI(): string
    {
        return $this->backendAPI;
    }

    /**
     * @return string
     */
    public function getShortSessionCookieName(): string
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
     * @throws AssertException
     */
    private function assertURL(string $url): void
    {
        Assert::stringNotEmpty($url);

        // @todo Add url value to exceptions

        $parts = parse_url($url);
        if ($parts === false) {
            throw new Exceptions\AssertException('Assert failed: parse_url() returned error');
        }

        if (isset($parts['scheme']) && $parts['scheme'] !== 'https') {
            throw new Exceptions\AssertException('Assert failed: scheme needs to be https');
        }

        if (!isset($parts['host'])) {
            throw new Exceptions\AssertException('Assert failed: host is empty');
        }

        if (isset($parts['user'])) {
            throw new Exceptions\AssertException('Assert failed: username needs to be empty');
        }

        if (isset($parts['pass'])) {
            throw new Exceptions\AssertException('Assert failed: password needs to be empty');
        }

        if (isset($parts['path'])) {
            throw new Exceptions\AssertException('Assert failed: path needs to be empty');
        }

        if (isset($parts['query'])) {
            throw new Exceptions\AssertException('Assert failed: querystring needs to be empty');
        }

        if (isset($parts['fragment'])) {
            throw new Exceptions\AssertException('Assert failed: fragment needs to be empty');
        }
    }
}
