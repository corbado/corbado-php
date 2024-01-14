<?php

namespace integration\EmailOTP;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeSendReq;
use Corbado\Generated\Model\EmailCodeValidateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailOTPValidateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailOTPValidateValidationErrorEmptyCode(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeValidateReq();
            $req->setCode('');

            Utils::SDK()->emailOTPs()->validate('emc-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['code: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailOTPValidateValidationErrorInvalidCode(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeValidateReq();
            $req->setCode('1');

            Utils::SDK()->emailOTPs()->validate('emc-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['code: the length must be exactly 6'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailOTPValidateValidationErrorInvalidID(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeValidateReq();
            $req->setCode('123456');

            Utils::SDK()->emailOTPs()->validate('emc-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailOTPValidateSuccess(): void
    {
        $req = new EmailCodeSendReq();
        $req->setEmail(Utils::createRandomTestEmail());
        $req->setCreate(true);

        $rsp = Utils::SDK()->emailOTPs()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());

        $req = new EmailCodeValidateReq();
        $req->setCode('150919');

        Utils::SDK()->emailOTPs()->validate($rsp->getData()->getEmailCodeId(), $req);
    }
}
