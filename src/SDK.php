<?php

namespace Corbado;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
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
    private Configuration $config;
    private ClientInterface $client;
    private ?EmailMagicLinkInterface $emailMagicLinks = null;
    private ?SmsOTPInterface $smsOTPs = null;
    private ?ValidationInterface $validations = null;
    private ?UserInterface $users = null;
    private ?SessionInterface $session = null;
    private ?AuthTokenInterface $authTokens = null;
    private ?EmailOTPInterface $emailOTPs = null;

    public const VERSION = '1.0.0';

    /**
     * Constructor
     *
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;

        if ($this->config->getHttpClient() === null) {
            $this->client = new Client(
                [
                    'base_uri' => $this->config->getBackendAPI(),
                    'http_errors' => false,
                    'auth' => [$this->config->getProjectID(), $this->config->getApiSecret()],
                    'headers' => ['X-Corbado-SDK-Version' => 'PHP SDK ' . self::VERSION],
                ]
            );
        } else {
            // SDK version might be missing, okay for now (auth needs to be set)
            $this->client = $this->config->getHttpClient();
        }
    }

    /**
     * Returns email magic link handling
     *
     * @return EmailMagicLinkInterface
     * @throws AssertException
     * @throws ConfigurationException
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
     * Returns SMS OTP handling
     *
     * @return SmsOTPInterface
     * @throws AssertException
     * @throws ConfigurationException
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
     * Returns validation handling
     *
     * @return ValidationInterface
     * @throws AssertException
     * @throws ConfigurationException
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
     * Returns user handling
     *
     * @return UserInterface
     * @throws AssertException
     * @throws ConfigurationException
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
     * Returns session handling
     *
     * @return SessionInterface
     * @throws ConfigurationException
     * @throws AssertException
     * @link https://docs.corbado.com/sessions/overview
     */
    public function sessions(): SessionInterface
    {
        if ($this->session === null) {
            if ($this->config->getJwksCachePool() === null) {
                throw new ConfigurationException('No JWKS cache pool set, use Configuration::setJwksCachePool()');
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
     * Returns auth token handling
     *
     * @return AuthTokenInterface
     * @throws ConfigurationException
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
     * Returns email OTP handling
     *
     * @throws AssertException
     * @throws ConfigurationException
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
     * @return Generated\Configuration
     * @throws ConfigurationException
     */
    private function createGeneratedConfiguration(): Generated\Configuration
    {
        if ($this->config->getApiSecret() == '') {
            throw new Exceptions\ConfigurationException('No API secret set, pass in constructor of configuration');
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
