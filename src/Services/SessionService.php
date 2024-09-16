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

    /**
     * Constructor
     *
     * @param ClientInterface $client
     * @param string $issuer
     * @param string $jwksURI
     * @param CacheItemPoolInterface $jwksCachePool
     * @throws AssertException
     */
    public function __construct(ClientInterface $client, string $issuer, string $jwksURI, CacheItemPoolInterface $jwksCachePool)
    {
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($jwksURI);

        $this->client = $client;
        $this->issuer = $issuer;
        $this->jwksURI = $jwksURI;
        $this->jwksCachePool = $jwksCachePool;
    }

    /**
     * Validates the given short-term session (represented as JWT) value
     *
     * @param string $shortSession Value (JWT)
     * @return UserEntity Returns UserEntity
     * @throws AssertException|ValidationException
     */
    public function validateToken(string $shortSession): UserEntity
    {
        Assert::stringNotEmpty($shortSession);

        $createException = function (string $message, string $jwt, int $code) {
            return new ValidationException(sprintf('JWT validation failed: "%s" (JWT: "%s")', $message, $jwt), $code);
        };

        try {
            $keySet = new CachedKeySet(
                $this->jwksURI,
                $this->client,
                new HttpFactory(),
                $this->jwksCachePool,
                null,
                true
            );

            $decoded = JWT::decode($shortSession, $keySet);
            if ($decoded->iss !== $this->issuer) {
                throw $createException(sprintf('Mismatch in issuer (configured through FrontendAPI: "%s", JWT issuer: "%s")', $this->issuer, $decoded->iss), $shortSession, ValidationException::CODE_JWT_ISSUER_MISMATCH);
            }

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
            throw $createException($e->getMessage(), $shortSession, ValidationException::CODE_JWT_INVALID_SIGNATURE);
        } catch (BeforeValidException $e) {
            throw $createException($e->getMessage(), $shortSession, ValidationException::CODE_JWT_BEFORE);
        } catch (ExpiredException $e) {
            throw $createException($e->getMessage(), $shortSession, ValidationException::CODE_JWT_EXPIRED);
        } catch (\UnexpectedValueException $e) {
            throw $createException($e->getMessage(), $shortSession, ValidationException::CODE_JWT_INVALID_DATA);
        } catch (Throwable $e) {
            throw $createException($e->getMessage(), $shortSession, ValidationException::CODE_JWT_GENERAL);
        }
    }
}
