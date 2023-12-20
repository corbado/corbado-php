<?php

namespace integration\SMSCode;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\SmsCodeSendReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class SMSCodeSendTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testSMSCodeSendValidationError(): void
    {
        $exception = null;

        try {
            $req = new SMSCodeSendReq();
            $req->setPhoneNumber('');

            Utils::SDK()->smsCodes()->send($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['phoneNumber: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testSMSCodeSendSuccess(): void
    {
        $req = new SMSCodeSendReq();
        $req->setPhoneNumber(Utils::createRandomTestPhoneNumber());
        $req->setCreate(true);

        $rsp = Utils::SDK()->smsCodes()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
