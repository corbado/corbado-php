<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

class Configuration {
    private string $baseURI = 'https://api.corbado.com';
    private string $projectID = '';
    private string $apiSecret = '';
    private string $authenticationURL = '';
    private string $shortSessionCookieName = 'cbo_short_session';
    private ?ClientInterface $httpClient = null;
    private ?CacheItemPoolInterface $jwksCachePool = null;

    /**
     * @throws Classes\Exceptions\Assert
     * @throws Classes\Exceptions\Configuration
     */
    public function setBaseURI(string $baseURI) : self
    {
        Assert::stringNotEmpty($baseURI);

        if (str_ends_with($baseURI, '/')) {
            throw new Classes\Exceptions\Configuration('Invalid base URI "' . $baseURI . '" given, needs to end without a slash');
        }

        $this->baseURI = $baseURI;

        return $this;
    }

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

    /**
     * @throws Classes\Exceptions\Assert
     */
    public function setAuthenticationURL(string $authenticationURL) : self
    {
        Assert::stringNotEmpty($authenticationURL);

        $parts = parse_url($authenticationURL);
        if ($parts === false) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given');
        }

        if (isset($parts['scheme']) && $parts['scheme'] !== 'https') {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, needs to be HTTPS');
        }

        if (!isset($parts['host'])) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, host is empty');
        }

        if (isset($parts['user'])) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, user needs to be empty');
        }

        if (isset($parts['pass'])) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, password needs to be empty');
        }

        if (isset($parts['path'])) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, path needs to be empty');
        }

        if (isset($parts['query'])) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, query needs to be empty');
        }

        if (isset($parts['fragment'])) {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, fragment needs to be empty');
        }

        $this->authenticationURL = $authenticationURL;

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

    public function getAuthenticationURL() : string
    {
        return $this->authenticationURL;
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