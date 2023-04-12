<?php

namespace Corbado;

use Corbado\Classes\EmailLinks;
use Corbado\Classes\ShortSession;
use Corbado\Classes\SMSCodes;
use Corbado\Classes\Validation;
use Corbado\Classes\WebAuthn;
use Corbado\Classes\Widget;
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

            $this->shortSession = new ShortSession($this->config->getJwksCachePool());
        }

        return $this->shortSession;
    }
}
