<?php

namespace unit;

use Corbado\Config;
use PHPUnit\Framework\TestCase;
use Throwable;

class ConfigTest extends TestCase
{
    /**
     * @dataProvider provideURLs
     * @param string $api
     * @param bool $valid
     * @return void
     */
    public function testConstructor(string $api, bool $valid): void
    {
        try {
            (new Config('pro-123', 'corbado1_123', $api, $api));
            $error = false;
        } catch (Throwable) {
            $error = true;
        }

        $this->assertEquals($valid, !$error);
    }

    public function testGetAPI(): void
    {
        $config = new Config('pro-123', 'corbado1_123', 'https://pro-123.frontendapi.cloud.corbado.io', 'https://backendapi.cloud.corbado.io');
        $this->assertEquals('https://pro-123.frontendapi.cloud.corbado.io', $config->getFrontendAPI());
        $this->assertEquals('https://backendapi.cloud.corbado.io', $config->getBackendAPI());
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
