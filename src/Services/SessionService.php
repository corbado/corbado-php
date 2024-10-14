<?php

namespace Corbado\Services;

use Corbado\Entities\UserEntity;
use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ValidationException;
use Corbado\Helper\Assert;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\CachedKeySet;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class SessionService implements SessionInterface
{
    private ClientInterface $client;
    private string $issuer;
    private string $jwksURI;
    private CacheItemPoolInterface $jwksCachePool;
    private string $projectID;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     * @param string $issuer
     * @param string $jwksURI
     * @param CacheItemPoolInterface $jwksCachePool
     * @throws AssertException
     */
    public function __construct(ClientInterface $client, string $issuer, string $jwksURI, CacheItemPoolInterface $jwksCachePool, string $projectID = '')
    {
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($jwksURI);

        $this->client = $client;
        $this->issuer = $issuer;
        $this->jwksURI = $jwksURI;
        $this->jwksCachePool = $jwksCachePool;
        $this->projectID = $projectID;
    }

    /**
     * Validates the given session-token
     *
     * @param string $sessionToken Value (JWT)
     * @return UserEntity Returns UserEntity
     * @throws AssertException|ValidationException
     */
    public function validateToken(string $sessionToken): UserEntity
    {
        Assert::stringNotEmpty($sessionToken);

        try {
            $keySet = new CachedKeySet(
                $this->jwksURI,
                $this->client,
                new HttpFactory(),
                $this->jwksCachePool,
                null,
                true
            );

            $decoded = JWT::decode($sessionToken, $keySet);
            $this->validateIssuer($decoded->iss, $sessionToken);

            $name = '';
            if (isset($decoded->name)) {
                $name = $decoded->name;
            }

            $email = '';
            if (isset($decoded->email)) {
                $email = $decoded->email;
            }

            $phoneNumber = '';
            if (isset($decoded->phone_number)) {
                $phoneNumber = $decoded->phone_number;
            }

            $orig = '';
            if (isset($decoded->orig)) {
                $orig = $decoded->orig;
            }

            return new UserEntity(
                $decoded->sub,
                $name,
                $email,
                $phoneNumber,
                $orig
            );
        } catch (ValidationException $e) {
            throw $e;
        } catch (SignatureInvalidException $e) {
            throw $this->createValidationException($e->getMessage(), $sessionToken, ValidationException::CODE_JWT_INVALID_SIGNATURE);
        } catch (BeforeValidException $e) {
            throw $this->createValidationException($e->getMessage(), $sessionToken, ValidationException::CODE_JWT_BEFORE);
        } catch (ExpiredException $e) {
            throw $this->createValidationException($e->getMessage(), $sessionToken, ValidationException::CODE_JWT_EXPIRED);
        } catch (\UnexpectedValueException $e) {
            throw $this->createValidationException($e->getMessage(), $sessionToken, ValidationException::CODE_JWT_INVALID_DATA);
        } catch (Throwable $e) {
            throw $this->createValidationException($e->getMessage(), $sessionToken, ValidationException::CODE_JWT_GENERAL);
        }
    }

    /**
     * @throws ValidationException
     */
    private function validateIssuer(string $jwtIssuer, string $sessionToken): void
    {
        if (empty($jwtIssuer)) {
            throw $this->createValidationException('Issuer is empty', $sessionToken, ValidationException::CODE_JWT_ISSUER_EMPTY);
        }

        // Compare to old Frontend API (without .cloud.) to make our Frontend API host name change downwards compatible
        if ($jwtIssuer === sprintf('https://%s.frontendapi.corbado.io', $this->projectID)) {
            return;
        }

        // Compare to new Frontend API (with .cloud.)
        if ($jwtIssuer === sprintf('https://%s.frontendapi.cloud.corbado.io', $this->projectID)) {
            return;
        }

        // Compare to configured issuer (from FrontendAPI), needed if you set a CNAME for example
        if ($jwtIssuer !== $this->issuer) {
            throw $this->createValidationException(
                sprintf('Mismatch in issuer (configured through FrontendAPI: "%s", JWT issuer: "%s")', $this->issuer, $jwtIssuer),
                $sessionToken,
                ValidationException::CODE_JWT_ISSUER_MISMATCH
            );
        }
    }

    private function createValidationException(string $message, string $jwt, int $code): ValidationException
    {
        return new ValidationException(sprintf('JWT validation failed: "%s" (JWT: "%s")', $message, $jwt), $code);
    }
}
