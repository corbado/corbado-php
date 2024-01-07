<?php

namespace unit;

use Corbado\Config;
use PHPUnit\Framework\TestCase;
use Throwable;

class ConfigTest extends TestCase
{
    /**
     * @dataProvider provideURLs
     * @param string $frontendAPI
     * @param bool $valid
     * @return void
     */
    public function testSetFrontendAPI(string $frontendAPI, bool $valid): void
    {
        try {
            $config = new Config('pro-123', 'corbado1_123');
            $config->setFrontendAPI($frontendAPI);
            $error = false;
        } catch (Throwable) {
            $error = true;
        }

        $this->assertEquals($valid, !$error);
    }

    /**
     * @dataProvider provideURLs
     * @param string $backendAPI
     * @param bool $valid
     * @return void
     */
    public function testSetBackendAPI(string $backendAPI, bool $valid): void
    {
        try {
            $config = new Config('pro-123', 'corbado1_123');
            $config->setBackendAPI($backendAPI);
            $error = false;
        } catch (Throwable) {
            $error = true;
        }

        $this->assertEquals($valid, !$error);
    }

    public function testGetFrontendAPI(): void
    {
        $config = new Config('pro-123', 'corbado1_123');
        $this->assertEquals('https://pro-123.frontendapi.corbado.io', $config->getFrontendAPI());
    }

    /**
     * @return array<int, array<int, bool|string>>
     */
    public function provideURLs(): array
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
