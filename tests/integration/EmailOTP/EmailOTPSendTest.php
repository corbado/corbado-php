<?php

namespace integration\EmailOTP;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeSendReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailOTPSendTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailOTPSendValidationError(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeSendReq();
            $req->setEmail('');

            Utils::SDK()->emailOTPs()->send($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['email: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailOTPSendSuccess(): void
    {
        $req = new EmailCodeSendReq();
        $req->setEmail(Utils::createRandomTestEmail());
        $req->setCreate(true);

        $rsp = Utils::SDK()->emailOTPs()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
