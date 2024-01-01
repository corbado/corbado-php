<?php

namespace integration\SmsOTP;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\SmsCodeSendReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class SmsOTPSendTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testSmsOTPSendValidationError(): void
    {
        $exception = null;

        try {
            $req = new SMSCodeSendReq();
            $req->setPhoneNumber('');

            Utils::SDK()->smsOTPs()->send($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['phoneNumber: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testSmsOTPSendSuccess(): void
    {
        $req = new SMSCodeSendReq();
        $req->setPhoneNumber(Utils::createRandomTestPhoneNumber());
        $req->setCreate(true);

        $rsp = Utils::SDK()->smsOTPs()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
