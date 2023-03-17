<?php

namespace Corbado;

use GuzzleHttp\Psr7\Request;

class Client
{
    private \GuzzleHttp\ClientInterface $client;
    private ?EmailLinks $emailLinks = null;
    private ?SMSCodes $smsCodes = null;
    private ?WebAuthn $webAuthn = null;
    private ?Validation $validation = null;
    private ?Widget $widget = null;

    public function __construct(string $username, string $password, string $baseURI = 'https://api.corbado.com/v1', ?\GuzzleHttp\ClientInterface $client = null)
    {
        if ($client === null) {
            $client = new \GuzzleHttp\Client(
                [
                    'base_uri' => $baseURI,
                    'http_errors' => false,
                    'auth' => [$username, $password]
                ]
            );
        }

        $this->client = $client;
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
}
