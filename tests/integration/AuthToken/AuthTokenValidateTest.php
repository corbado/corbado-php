<?php

namespace integration\AuthToken;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\SDK;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class AuthTokenValidateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testAuthTokenValidateValidationErrorEmptyToken(): void
    {
        $exception = null;

        try {
            $req = new AuthTokenValidateReq();
            $req->setToken('');
            $req->setClientInfo(SDK::createClientInfo('124.0.0.1', 'IntegrationTest'));

            Utils::SDK()->authTokens()->validate($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['token: cannot be blank'], $exception->getValidationMessages());
    }

    public function testAuthTokenValidateValidationErrorInvalidToken(): void
    {
        $exception = null;

        try {
            $req = new AuthTokenValidateReq();
            $req->setToken('x');
            $req->setClientInfo(SDK::createClientInfo('124.0.0.1', 'IntegrationTest'));

            Utils::SDK()->authTokens()->validate($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['token: the length must be exactly 64'], $exception->getValidationMessages());
    }

    public function testAuthTokenValidateValidationErrorNotExistingToken(): void
    {
        $exception = null;

        try {
            $req = new AuthTokenValidateReq();
            $req->setToken(Utils::generateString(64));
            $req->setClientInfo(SDK::createClientInfo('124.0.0.1', 'IntegrationTest'));

            Utils::SDK()->authTokens()->validate($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }
}
