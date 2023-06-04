<?php

namespace Corbado;

use Corbado\Classes\Apis\EmailLinks;
use Corbado\Classes\Apis\ShortSession;
use Corbado\Classes\Apis\ShortSessionInterface;
use Corbado\Classes\Apis\SMSCodes;
use Corbado\Classes\Apis\Validation;
use Corbado\Classes\Apis\WebAuthn;
use Corbado\Classes\Apis\Widget;
use Corbado\Classes\Exceptions\Assert;
use Corbado\Classes\User;
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
    private ?Widget $widget;
    private ?ShortSessionInterface $shortSession = null;

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

    public function widget() : Widget {
        if ($this->widget === null) {
            $this->widget = new Widget($this->client);
        }

        return $this->widget;
    }

    public function setShortSession(ShortSessionInterface $shortSession) : void {
        $this->shortSession = $shortSession;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Configuration|Assert
     */
    public function shortSession() : ShortSessionInterface {
        if ($this->shortSession === null) {
            if ($this->config->getAuthenticationURL() === '') {
                throw new Classes\Exceptions\Configuration('No authentication URL set, use Configuration::setAuthenticationURL()');
            }

            if ($this->config->getJwksCachePool() === null) {
                throw new Classes\Exceptions\Configuration('No JWKS cache pool set, use Configuration::setJwksCachePool()');
            }

            $this->shortSession = new ShortSession(
                $this->config->getShortSessionCookieName(),
                $this->config->getAuthenticationURL(),
                $this->config->getAuthenticationURL() . '/.well-known/jwks.json',
                $this->client,
                $this->config->getJwksCachePool()
            );
        }

        return $this->shortSession;
    }

    /**
     * @throws Assert
     * @throws \Corbado\Classes\Exceptions\Configuration
     */
    public function getUser() : User {
        $jwt = $this->shortSession()->getValue();

        $guest = new User(false);
        if (strlen($jwt) < 10) {
            return $guest;
        }

        $decoded = $this->shortSession()->validate($jwt);
        if ($decoded !== null) {
            return new User(
                true,
                $decoded->sub,
                $decoded->name,
                $decoded->email,
                $decoded->phoneNumber
            );
        }

        return $guest;
    }
}
