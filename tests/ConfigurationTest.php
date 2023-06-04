<?php

use Corbado\Configuration;
use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    /**
     * @dataProvider provideAuthenticationURLs
     * @param string $authenticationURL
     * @param bool $valid
     * @return void
     */
    public function testSetAuthenticationURL(string $authenticationURL, bool $valid) : void
    {
        try {
            $config = new Configuration();
            $config->setAuthenticationURL($authenticationURL);
            $error = false;
        } catch (Throwable $e) {
            $error = true;
            echo $e->getMessage();
        }

        $this->assertEquals($valid, !$error);
    }

    /**
     * @return array<int, array<int, bool|string>>
     */
    public function provideAuthenticationURLs() : array
    {
        return [
            ['', false],
            ['xxx', false],
            ['http://auth.acme.com', false], // Only HTTPS
            ['https://user@auth.acme.com', false], // No user
            ['https://user:pass@auth.acme.com', false], // No user no password
            ['https://auth.acme.com/', false], // No path (/)
            ['https://auth.acme.com?xxx', false], // No query string
            ['https://auth.acme.com#xxx', false], // No fragment
            ['https://auth.acme.com', true],
        ];
    }
}