<?php

namespace Corbado;

use Corbado\Classes\Apis\EmailLinks;
use Corbado\Classes\Apis\SMSCodes;
use Corbado\Classes\Apis\Validation;
use Corbado\Classes\Apis\WebAuthn;
use Corbado\Classes\Assert;
use Corbado\Classes\Session;
use Corbado\Classes\SessionInterface;
use Corbado\Generated\Api\UserApi;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class SDK
{
    private Configuration $config;
    private ClientInterface $client;
    private ?EmailLinks $emailLinks;
    private ?SMSCodes $smsCodes;
    private ?WebAuthn $webAuthn;
    private ?Validation $validation;
    private ?UserApi $users;
    private ?SessionInterface $session = null;
    private ?string $sessionVersion = null;

    /**
     * @throws \Corbado\Classes\Exceptions\Configuration
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        if ($this->config->getHttpClient() === null) {
            if ($this->config->getProjectID() === '') {
                throw new Classes\Exceptions\Configuration('No project ID set, use Configuration::setProjectID()');
            }

            if ($this->config->getApiSecret() === '') {
                throw new Classes\Exceptions\Configuration('No API secret set, use Configuration::setApiSecret()');
            }

            $this->client = new Client(
                [
                    'base_uri' => $this->config->getBaseURI(),
                    'http_errors' => false,
                    'auth' => [$this->config->getProjectID(), $this->config->getApiSecret()]
                ]
            );
        } else {
            $this->client = $this->config->getHttpClient();
        }
    }

    public function emailLinks() : EmailLinks {
        if ($this->emailLinks === null) {
            $this->emailLinks = new EmailLinks($this->client);
        }

        return $this->emailLinks;
    }

    public function smsCodes() : SMSCodes {
        if ($this->smsCodes === null) {
            $this->smsCodes = new SMSCodes($this->client);
        }

        return $this->smsCodes;
    }

    public function webAuthn() : WebAuthn {
        if ($this->webAuthn === null) {
            $this->webAuthn = new WebAuthn($this->client);
        }

        return $this->webAuthn;
    }

    public function validation() : Validation {
        if ($this->validation === null) {
            $this->validation = new Validation($this->client);
        }

        return $this->validation;
    }

    public function users() : UserApi {
        if ($this->users === null) {
            $config = new Generated\Configuration();
            $config->setUsername($this->config->getProjectID());
            $config->setPassword($this->config->getApiSecret());
            // @phpstan-ignore-next-line
            $config->setAccessToken(null); // Need to null this out, otherwise it will try to use it

            // @phpstan-ignore-next-line
            $this->users = new UserApi($this->client, $config);
        }

        return $this->users;
    }

    public function session(string $version = 'v2') : SessionInterface {
        Assert::stringEquals($version, ['v1', 'v2']);

        if ($this->sessionVersion !== null && $this->sessionVersion != $version) {
            throw new \LogicException('Called session with different version before (recreate SDK instance to use different version)');
        }

        if ($this->session === null) {
            $this->sessionVersion = $version;

            if ($version === 'v2') {
                if ($this->config->getAuthenticationURL() === '') {
                    throw new Classes\Exceptions\Configuration('No authentication URL set, use Configuration::setAuthenticationURL()');
                }

                if ($this->config->getJwksCachePool() === null) {
                    throw new Classes\Exceptions\Configuration('No JWKS cache pool set, use Configuration::setJwksCachePool()');
                }

                $this->session = new Session(
                    $version,
                    $this->client,
                    $this->config->getShortSessionCookieName(),
                    $this->config->getAuthenticationURL(),
                    $this->config->getAuthenticationURL() . '/.well-known/jwks',
                    $this->config->getJwksCachePool()
                );
            } else {
                $this->session = new Session(
                    $version,
                    $this->client,
                    '',
                    '',
                    '',
                    null
                );
            }
        }

        return $this->session;
    }
}
