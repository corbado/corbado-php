<?php

namespace Corbado;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Generated\Api\IdentifiersApi;
use Corbado\Generated\Api\UsersApi;
use Corbado\Helper\Assert;
use Corbado\Services\IdentifierInterface;
use Corbado\Services\IdentifierService;
use Corbado\Services\SessionInterface;
use Corbado\Services\SessionService;
use Corbado\Services\UserInterface;
use Corbado\Services\UserService;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class SDK
{
    private Config $config;
    private ClientInterface $client;
    private ?SessionInterface $session = null;
    private ?UserInterface $users = null;
    private ?IdentifierInterface $identifiers = null;

    public const VERSION = '4.1.0';

    /**
     * Constructor
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;

        if ($this->config->getHttpClient() === null) {
            $this->client = new Client(
                [
                    'base_uri' => $this->config->getBackendAPI(),
                    'http_errors' => false,
                    'auth' => [$this->config->getProjectID(), $this->config->getApiSecret()],
                    'headers' => ['X-Corbado-SDK' => json_encode(
                        ['name' => 'PHP SDK', 'sdkVersion' => self::VERSION, 'languageVersion' => PHP_VERSION]
                    )]
                ]
            );
        } else {
            // SDK information might be missing, okay for now (auth needs to be set)
            $this->client = $this->config->getHttpClient();
        }
    }

    /**
     * Returns session handling
     *
     * @return SessionInterface
     * @throws ConfigException
     * @throws AssertException
     * @link https://docs.corbado.com/sessions/overview
     */
    public function sessions(): SessionInterface
    {
        if ($this->session === null) {
            if ($this->config->getJwksCachePool() === null) {
                throw new ConfigException('No JWKS cache pool set, use Configuration::setJwksCachePool()');
            }

            $this->session = new SessionService(
                $this->client,
                $this->config->getFrontendAPI(),
                $this->config->getFrontendAPI() . '/.well-known/jwks',
                $this->config->getJwksCachePool(),
                $this->config->getProjectID()
            );
        }

        return $this->session;
    }

    /**
     * Returns user handling
     *
     * @return UserInterface
     * @throws AssertException
     * @throws ConfigException
     */
    public function users(): UserInterface
    {
        if ($this->users === null) {
            $this->users = new UserService(
                // @phpstan-ignore-next-line
                new UsersApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->users;
    }

    /**
     * Returns identifier handling
     *
     * @return IdentifierInterface
     * @throws AssertException
     * @throws ConfigException
     */
    public function identifiers(): IdentifierInterface
    {
        if ($this->identifiers === null) {
            $this->identifiers = new IdentifierService(
                // @phpstan-ignore-next-line
                new IdentifiersApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->identifiers;
    }

    /**
     * @return Generated\Configuration
     */
    private function createGeneratedConfiguration(): Generated\Configuration
    {
        $config = new Generated\Configuration();
        $config->setHost($this->config->getBackendAPI() . '/v2');
        $config->setUsername($this->config->getProjectID());
        $config->setPassword($this->config->getApiSecret());
        // @phpstan-ignore-next-line
        $config->setAccessToken(null); // Need to null this out, otherwise it will try to use it

        return $config;
    }
}
