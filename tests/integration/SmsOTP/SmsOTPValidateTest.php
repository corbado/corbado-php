<?php

namespace integration\SmsOTP;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeValidateReq;
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
}
