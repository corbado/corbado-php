<?php

namespace integration\AuthToken;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\Generated\Model\EmailCodeValidateReq;
use Corbado\Generated\Model\EmailLinksValidateReq;
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
            $req->setClientInfo(Utils::createClientInfo());

            Utils::SDK()->authTokens()->validate($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['token: cannot be blank'], $exception->getValidationMessages());
    }
}
