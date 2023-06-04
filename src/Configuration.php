<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;

class Configuration {
    private string $baseURI = 'https://api.corbado.com/v1';
    private string $projectID = '';
    private string $apiSecret = '';
    private string $shortSessionCookieName = 'cbo_short_session';
    private ?ClientInterface $httpClient = null;
    private ?CacheItemPoolInterface $jwksCachePool = null;
    private string $issuer = '';
    private string $authorizedParty = '';
    private string $jwksURI = '';

    private string $authenticationURL = '';

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function setBaseURI(string $baseURI) : self
    {
        Assert::stringNotEmpty($baseURI);

        $this->baseURI = $baseURI;

        return $this;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws \Corbado\Classes\Exceptions\Configuration
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
     * @throws \Corbado\Classes\Exceptions\Assert
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
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function setIssuer(string $issuer) : self
    {
        Assert::stringNotEmpty($issuer);

        $this->issuer = $issuer;

        return $this;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function setAuthorizedParty(string $authorizedParty) : self
    {
        Assert::stringNotEmpty($authorizedParty);

        $this->authorizedParty = $authorizedParty;

        return $this;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function setJwksURI(string $jwksURI) : self
    {
        Assert::stringNotEmpty($jwksURI);

        $this->jwksURI = $jwksURI;

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

        if ($parts['scheme'] !== 'https') {
            throw new Classes\Exceptions\Assert('Invalid authentication URL "' . $authenticationURL . '" given, needs to be HTTPS');
        }

        if ($parts['host'] === '') {
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

    public function getIssuer() : string
    {
        return $this->issuer;
    }

    public function getAuthorizedParty() : string
    {
        return $this->authorizedParty;
    }

    public function getJwksURI() : string
    {
        return $this->jwksURI;
    }

    public function getAuthenticationURL() : string
    {
        return $this->authenticationURL;
    }
}