<?php

namespace integration\SmsOTP;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeSendReq;
use Corbado\Generated\Model\EmailCodeValidateReq;
use Corbado\Generated\Model\SmsCodeSendReq;
use Corbado\Generated\Model\SmsCodeValidateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class SmsOTPValidateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testSmsOTPValidateValidationErrorEmptyCode(): void
    {
        $exception = null;

        try {
            $req = new SmsCodeValidateReq();
            $req->setSmsCode('');

            Utils::SDK()->smsOTPs()->validate('sms-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['smsCode: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testSmsOTPValidateValidationErrorInvalidCode(): void
    {
        $exception = null;

        try {
            $req = new SmsCodeValidateReq();
            $req->setSmsCode('1');

            Utils::SDK()->smsOTPs()->validate('sms-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['smsCode: the length must be exactly 6'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testSmsOTPValidateValidationErrorInvalidID(): void
    {
        $exception = null;

        try {
            $req = new SmsCodeValidateReq();
            $req->setSmsCode('123456');

            Utils::SDK()->smsOTPs()->validate('sms-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testSmsOTPValidateSuccess(): void
    {
        $req = new SmsCodeSendReq();
        $req->setPhoneNumber(Utils::createRandomTestPhoneNumber());
        $req->setCreate(true);

        $rsp = Utils::SDK()->smsOTPs()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());

        $req = new SmsCodeValidateReq();
        $req->setSmsCode('150919');

        Utils::SDK()->smsOTPs()->validate($rsp->getData()->getSmsCodeId(), $req);
    }
}
