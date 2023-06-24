<?php

namespace Corbado;

use Corbado\Classes\Apis\EmailLinks;
use Corbado\Classes\Apis\SMSCodes;
use Corbado\Classes\Apis\Validation;
use Corbado\Classes\Apis\WebAuthn;
use Corbado\Classes\Apis\Widget;
use Corbado\Classes\Assert;
use Corbado\Classes\Session;
use Corbado\Generated\Api\AuthTokensApi;
use Corbado\Generated\Api\UserApi;
use Corbado\Generated\Model\ClientInfo;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class SDK
{
    private Configuration $config;
    private ClientInterface $client;
    private ?EmailLinks $emailLinks = null;
    private ?SMSCodes $smsCodes = null;
    private ?WebAuthn $webAuthn = null;
    private ?Validation $validation = null;
    private ?Widget $widget = null;
    private ?UserApi $users = null;
    private ?Session $session = null;
    private ?AuthTokensApi $authTokens = null;

    /**
     * Constructor
     *
     * @param Configuration $config
     * @throws Classes\Exceptions\Configuration
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        if ($this->config->getHttpClient() === null) {
            $this->client = new Client(
                [
                    'base_uri' => $this->config->getBackendAPI(),
                    'http_errors' => false,
                    'auth' => [$this->config->getProjectID(), $this->config->getApiSecret()]
                ]
            );
        } else {
            $this->client = $this->config->getHttpClient();
        }
    }

    /**
     * Returns email links handling
     *
     * @return EmailLinks
     */
    public function emailLinks() : EmailLinks {
        if ($this->emailLinks === null) {
            $this->emailLinks = new EmailLinks($this->client);
        }

        return $this->emailLinks;
    }

    /**
     * Returns SMS codes handling
     *
     * @return SMSCodes
     */
    public function smsCodes() : SMSCodes {
        if ($this->smsCodes === null) {
            $this->smsCodes = new SMSCodes($this->client);
        }

        return $this->smsCodes;
    }

    /**
     * Returns WebAuthn handling
     *
     * @return WebAuthn
     */
    public function webAuthn() : WebAuthn {
        if ($this->webAuthn === null) {
            $this->webAuthn = new WebAuthn($this->client);
        }

        return $this->webAuthn;
    }

    /**
     * Returns validation handling
     *
     * @return Validation
     */
    public function validation() : Validation {
        if ($this->validation === null) {
            $this->validation = new Validation($this->client);
        }

        return $this->validation;
    }

    public function widget() : Widget {
        if ($this->widget === null) {
            $this->widget = new Widget($this->client);
        }

        return $this->widget;
    }

    /**
     * Returns users handling
     *
     * @throws Classes\Exceptions\Configuration
     * @return UserApi
     */
    public function users() : UserApi {
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
     * @throws Classes\Exceptions\Assert
     * @throws Classes\Exceptions\Configuration
     * @link https://docs.corbado.com/sessions/overview
     */
    public function sessions() : Session {
        if ($this->session === null) {
            if ($this->config->getJwksCachePool() === null) {
                throw new Classes\Exceptions\Configuration('No JWKS cache pool set, use Configuration::setJwksCachePool()');
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
     * @throws Classes\Exceptions\Configuration
     * @return AuthTokensApi
     */
    public function authTokens() : AuthTokensApi {
        if ($this->authTokens === null) {
            // @phpstan-ignore-next-line
            $this->authTokens = new AuthTokensApi($this->client, $this->createGeneratedConfiguration());
        }

        return $this->authTokens;
    }

    /**
     * @return Generated\Configuration
     * @throws Classes\Exceptions\Configuration
     */
    private function createGeneratedConfiguration() : Generated\Configuration
    {
        if ($this->config->getApiSecret() == '') {
            throw new Classes\Exceptions\Configuration('No API secret set, pass in constructor of configuration');
        }

        $config = new Generated\Configuration();
        $config->setUsername($this->config->getProjectID());
        $config->setPassword($this->config->getApiSecret());
        // @phpstan-ignore-next-line
        $config->setAccessToken(null); // Need to null this out, otherwise it will try to use it

        return $config;
    }

    /**
     * @throws Classes\Exceptions\Assert
     */
    public static function createClientInfo(string $remoteAddress, string $userAgent) : ClientInfo {
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $client = new ClientInfo();
        $client
            ->setRemoteAddress($remoteAddress)
            ->setUserAgent($userAgent);

        return $client;
    }
}
