<?php

namespace Corbado;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Generated\Api\AuthTokensApi;
use Corbado\Generated\Api\EmailMagicLinksApi;
use Corbado\Generated\Api\EmailOTPApi;
use Corbado\Generated\Api\SMSOTPApi;
use Corbado\Generated\Api\UserApi;
use Corbado\Generated\Api\ValidationApi;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Helper\Assert;
use Corbado\Services\AuthTokenInterface;
use Corbado\Services\AuthTokenService;
use Corbado\Services\EmailMagicLinkInterface;
use Corbado\Services\EmailMagicLinkService;
use Corbado\Services\EmailOTPInterface;
use Corbado\Services\EmailOTPService;
use Corbado\Services\SessionInterface;
use Corbado\Services\SessionService;
use Corbado\Services\SmsOTPInterface;
use Corbado\Services\SmsOTPService;
use Corbado\Services\UserInterface;
use Corbado\Services\UserService;
use Corbado\Services\ValidationInterface;
use Corbado\Services\ValidationService;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class SDK
{
    private Config $config;
    private ClientInterface $client;
    private ?AuthTokenInterface $authTokens = null;
    private ?EmailMagicLinkInterface $emailMagicLinks = null;
    private ?EmailOTPInterface $emailOTPs = null;
    private ?SessionInterface $session = null;
    private ?SmsOTPInterface $smsOTPs = null;
    private ?UserInterface $users = null;
    private ?ValidationInterface $validations = null;

    public const VERSION = '3.0.1';

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
     * Returns auth token handling
     *
     * @return AuthTokenInterface
     * @throws ConfigException
     * @throws AssertException
     */
    public function authTokens(): AuthTokenInterface
    {
        if ($this->authTokens === null) {
            $this->authTokens = new AuthTokenService(
                // @phpstan-ignore-next-line
                new AuthTokensApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->authTokens;
    }

    /**
     * Returns email magic link handling
     *
     * @return EmailMagicLinkInterface
     * @throws AssertException
     * @throws ConfigException
     */
    public function emailMagicLinks(): EmailMagicLinkInterface
    {
        if ($this->emailMagicLinks === null) {
            $this->emailMagicLinks = new EmailMagicLinkService(
                // @phpstan-ignore-next-line
                new EmailMagicLinksApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->emailMagicLinks;
    }

    /**
     * Returns email OTP handling
     *
     * @throws AssertException
     * @throws ConfigException
     */
    public function emailOTPs(): EmailOTPInterface
    {
        if ($this->emailOTPs === null) {
            $this->emailOTPs = new EmailOTPService(
                // @phpstan-ignore-next-line
                new EmailOTPApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->emailOTPs;
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
                $this->config->getShortSessionCookieName(),
                $this->config->getFrontendAPI(),
                $this->config->getFrontendAPI() . '/.well-known/jwks',
                $this->config->getJwksCachePool()
            );
        }

        return $this->session;
    }

    /**
     * Returns SMS OTP handling
     *
     * @return SmsOTPInterface
     * @throws AssertException
     * @throws ConfigException
     */
    public function smsOTPs(): SmsOTPInterface
    {
        if ($this->smsOTPs === null) {
            $this->smsOTPs = new SmsOTPService(
                // @phpstan-ignore-next-line
                new SMSOTPApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->smsOTPs;
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
                new UserApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->users;
    }

    /**
     * Returns validation handling
     *
     * @return ValidationInterface
     * @throws AssertException
     * @throws ConfigException
     */
    public function validations(): ValidationInterface
    {
        if ($this->validations === null) {
            $this->validations = new ValidationService(
                // @phpstan-ignore-next-line
                new ValidationApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->validations;
    }

    /**
     * @return Generated\Configuration
     * @throws ConfigException
     */
    private function createGeneratedConfiguration(): Generated\Configuration
    {
        if ($this->config->getApiSecret() == '') {
            throw new Exceptions\ConfigException('No API secret set, pass in constructor of configuration');
        }

        $config = new Generated\Configuration();
        $config->setHost($this->config->getBackendAPI());
        $config->setUsername($this->config->getProjectID());
        $config->setPassword($this->config->getApiSecret());
        // @phpstan-ignore-next-line
        $config->setAccessToken(null); // Need to null this out, otherwise it will try to use it

        return $config;
    }

    /**
     * @throws AssertException
     */
    public static function createClientInfo(string $remoteAddress, string $userAgent): ClientInfo
    {
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $client = new ClientInfo();
        $client
            ->setRemoteAddress($remoteAddress)
            ->setUserAgent($userAgent);

        return $client;
    }
}
