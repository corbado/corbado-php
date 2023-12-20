<?php

namespace Corbado;

use Corbado\Services\AuthTokens;
use Corbado\Services\AuthTokensInterface;
use Corbado\Services\EmailOTPs;
use Corbado\Services\EmailOTPsInterface;
use Corbado\Services\EmailMagicMagicLinks;
use Corbado\Services\EmailMagicLinksInterface;
use Corbado\Services\SmsOTPs;
use Corbado\Services\SmsOTPsInterface;
use Corbado\Services\Users;
use Corbado\Services\UsersInterface;
use Corbado\Services\Validations;
use Corbado\Services\ValidationsInterface;
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
use Corbado\Session\Session;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class SDK
{
    private Configuration $config;
    private ClientInterface $client;
    private ?EmailMagicLinksInterface $emailMagicLinks = null;
    private ?SmsOTPsInterface $smsOTPs = null;
    private ?ValidationsInterface $validations = null;
    private ?UsersInterface $users = null;
    private ?Session $session = null;
    private ?AuthTokensInterface $authTokens = null;
    private ?EmailOTPsInterface $emailOTPs = null;

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
     * @return EmailMagicLinksInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function emailMagicLinks(): EmailMagicLinksInterface
    {
        if ($this->emailMagicLinks === null) {
            $this->emailMagicLinks = new EmailMagicMagicLinks(
                // @phpstan-ignore-next-line
                new EmailMagicLinksApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->emailMagicLinks;
    }

    /**
     * Returns SMS OTP handling
     *
     * @return SmsOTPsInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function smsOTPs(): SmsOTPsInterface
    {
        if ($this->smsOTPs === null) {
            $this->smsOTPs = new SmsOTPs(
                // @phpstan-ignore-next-line
                new SMSOTPApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->smsOTPs;
    }

    /**
     * Returns validation handling
     *
     * @return ValidationsInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function validations(): ValidationsInterface
    {
        if ($this->validations === null) {
            $this->validations = new Validations(
                // @phpstan-ignore-next-line
                new ValidationApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->validations;
    }

    /**
     * Returns user handling
     *
     * @return UsersInterface
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function users(): UsersInterface
    {
        if ($this->users === null) {
            $this->users = new Users(
                // @phpstan-ignore-next-line
                new UserApi($this->client, $this->createGeneratedConfiguration())
            );
        }

        return $this->users;
    }

    /**
     * Returns session handling
     *
     * @return Session
     * @throws ConfigurationException
     * @throws AssertException
     * @link https://docs.corbado.com/sessions/overview
     */
    public function sessions(): Session
    {
        if ($this->session === null) {
            if ($this->config->getJwksCachePool() === null) {
                throw new ConfigurationException('No JWKS cache pool set, use Configuration::setJwksCachePool()');
            }

            $this->session = new Session(
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
     * @return AuthTokensInterface
     * @throws ConfigurationException
     * @throws AssertException
     */
    public function authTokens(): AuthTokensInterface
    {
        if ($this->authTokens === null) {
            $this->authTokens = new AuthTokens(
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
    public function emailOTPs(): EmailOTPsInterface
    {
        if ($this->emailOTPs === null) {
            $this->emailOTPs = new EmailOTPs(
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
