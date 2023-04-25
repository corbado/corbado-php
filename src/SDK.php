<?php

namespace Corbado;

use Corbado\Classes\Apis\EmailLinks;
use Corbado\Classes\Apis\ShortSession;
use Corbado\Classes\Apis\SMSCodes;
use Corbado\Classes\Apis\Validation;
use Corbado\Classes\Apis\WebAuthn;
use Corbado\Classes\Apis\Widget;
use Corbado\Classes\User;
use Corbado\Exceptions\Assert;
use Corbado\Exceptions\Standard;
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
    private ?ShortSession $shortSession = null;

    /**
     * @throws Exceptions\Configuration
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        if ($this->config->getHttpClient() === null) {
            if ($this->config->getProjectID() === '') {
                throw new \Corbado\Exceptions\Configuration('No project ID set, use Configuration::setProjectID()');
            }

            if ($this->config->getApiSecret() === '') {
                throw new \Corbado\Exceptions\Configuration('No API secret set, use Configuration::setApiSecret()');
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

    /**
     * @throws Exceptions\Configuration
     */
    public function shortSession() : ShortSession {
        if ($this->shortSession === null) {
            if ($this->config->getJwksCachePool() === null) {
                throw new \Corbado\Exceptions\Configuration('No JWKS cache pool set, use Configuration::setJwksCachePool()');
            }

            $this->shortSession = new ShortSession('', '', '', $this->client, $this->config->getJwksCachePool());
        }

        return $this->shortSession;
    }

    /**
     * @throws Standard
     * @throws Assert
     * @throws Exceptions\Configuration
     */
    public function getUser() : User {
        if (!empty($_COOKIE[$this->config->getShortSessionCookieName()])) {
            $jwt = $_COOKIE[$this->config->getShortSessionCookieName()];
        } else if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            $jwt = $this->extractBearerToken($_SERVER['HTTP_AUTHORIZATION']);
        }

        if (strlen($jwt) < 10) {
            throw new Standard('Could not extract JWT from cookie or Authorization header');
        }

        $authenticated = $this->shortSession()->validate($jwt);

        return new User($authenticated, 'TODO');
    }

    /**
     * @throws Assert
     */
    private function extractBearerToken($authorizationHeader) : string {
        Classes\Assert::stringNotEmpty($authorizationHeader);

        if (!str_starts_with($authorizationHeader, 'Bearer ')) {
            return '';
        }

        return substr($authorizationHeader, 7);
    }
}
