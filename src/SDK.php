<?php

namespace Corbado;

use Corbado\Classes\Apis\AuthTokens;
use Corbado\Classes\Apis\AuthTokensInterface;
use Corbado\Classes\Apis\EmailLinks;
use Corbado\Classes\Apis\EmailLinksInterface;
use Corbado\Classes\Apis\SMSCodes;
use Corbado\Classes\Apis\SMSCodesInterface;
use Corbado\Classes\Apis\Validations;
use Corbado\Classes\Apis\ValidationsInterface;
use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Session;
use Corbado\Generated\Api\AuthTokensApi;
use Corbado\Generated\Api\EmailMagicLinksApi;
use Corbado\Generated\Api\SMSOTPApi;
use Corbado\Generated\Api\UserApi;
use Corbado\Generated\Api\ValidationApi;
use Corbado\Generated\Model\ClientInfo;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class SDK
{
    private Configuration $config;
    private ClientInterface $client;
    private ?EmailLinksInterface $emailLinks = null;
    private ?SMSCodesInterface $smsCodes = null;
    private ?ValidationsInterface $validations = null;
    private ?UserApi $users = null;
    private ?Session $session = null;
    private ?AuthTokensInterface $authTokens = null;

    const VERSION = '1.0.0';

    /**
     * Constructor
     *
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        if ($this->config->getHttpClient() === null) {
            $this->client = new Client(
                [
                    'base_uri' => $this->config->getBackendAPI(),
                    'http_errors' => false,
                    'auth' => [$this->config->getProjectID(), $this->config->getApiSecret()],
                    'headers' => ['X-Corbado-SDK-Version' => 'PHP SDK ' . self::VERSION],
                ]
            );
        } else {
            $this->client = $this->config->getHttpClient();
        }
    }

    /**
     * Returns email links handling
     *
     * @return EmailLinksInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function emailLinks(): EmailLinksInterface
    {
        if ($this->emailLinks === null) {
            $this->emailLinks = new EmailLinks(
                // @phpstan-ignore-next-line
                new EmailMagicLinksApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->emailLinks;
    }

    /**
     * Returns SMS codes handling
     *
     * @return SMSCodesInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function smsCodes(): SMSCodesInterface
    {
        if ($this->smsCodes === null) {
            $this->smsCodes = new SMSCodes(
                // @phpstan-ignore-next-line
                new SMSOTPApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->smsCodes;
    }

    /**
     * Returns validation handling
     *
     * @return ValidationsInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function validations(): ValidationsInterface
    {
        if ($this->validations === null) {
            $this->validations = new Validations(
                // @phpstan-ignore-next-line
                new ValidationApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->validations;
    }

    /**
     * Returns users handling
     *
     * @return UserApi
     * @throws ConfigurationException
     */
    public function users(): UserApi
    {
        if ($this->users === null) {
            // @phpstan-ignore-next-line
            $this->users = new UserApi($this->client, $this->createGeneratedConfiguration());
        }

        return $this->users;
    }

    /**
     * Returns session handling
     *
     * @return Session
     * @throws ConfigurationException
     * @throws AssertException
     * @link https://docs.corbado.com/sessions/overview
     */
    public function sessions(): Session
    {
        if ($this->session === null) {
            if ($this->config->getJwksCachePool() === null) {
                throw new ConfigurationException('No JWKS cache pool set, use Configuration::setJwksCachePool()');
            }

            $this->session = new Session(
                $this->client,
                $this->config->getShortSessionCookieName(),
                $this->config->getFrontendAPI(),
                $this->config->getFrontendAPI() . '/.well-known/jwks',
                $this->config->getJwksCachePool()
            );
        }

        return $this->session;
    }

    /**
     * Returns auth tokens handling
     *
     * @return AuthTokensInterface
     * @throws ConfigurationException
     * @throws AssertException
     */
    public function authTokens(): AuthTokensInterface
    {
        if ($this->authTokens === null) {
            $this->authTokens = new AuthTokens(
                // @phpstan-ignore-next-line
                new AuthTokensApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->authTokens;
    }

    /**
     * @return Generated\Configuration
     * @throws Classes\Exceptions\ConfigurationException
     */
    private function createGeneratedConfiguration(): Generated\Configuration
    {
        if ($this->config->getApiSecret() == '') {
            throw new Classes\Exceptions\ConfigurationException('No API secret set, pass in constructor of configuration');
        }

        $config = new Generated\Configuration();
        $config->setHost($this->config->getBackendAPI());
        $config->setUsername($this->config->getProjectID());
        $config->setPassword($this->config->getApiSecret());
        // @phpstan-ignore-next-line
        $config->setAccessToken(null); // Need to null this out, otherwise it will try to use it

        return $config;
    }

    /**
     * @throws Classes\Exceptions\AssertException
     */
    public static function createClientInfo(string $remoteAddress, string $userAgent): ClientInfo
    {
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $client = new ClientInfo();
        $client
            ->setRemoteAddress($remoteAddress)
            ->setUserAgent($userAgent);

        return $client;
    }
}
