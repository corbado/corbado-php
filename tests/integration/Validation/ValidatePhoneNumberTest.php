<?php

namespace integration\Validation;

use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\ValidateEmailReq;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class ValidatePhoneNumberTest extends TestCase
{
    public function testValidatePhoneNumberValidationError(): void
    {
        $rsp = null;
        $exception = null;

        try {
            $req = new ValidatePhoneNumberReq();
            $req->setPhoneNumber('');

            $rsp = Utils::SDK()->validations()->validatePhoneNumber($req);
        } catch (ServerException $e) {
            $exception = $e;
        } catch (\Throwable $e) {
            $this->fail(Utils::createExceptionFailMessage($e));
        }

        $this->assertNull($rsp);
        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEquals('phoneNumber: cannot be blank', $exception->getValidationMessage());
    }

    public function testValidatePhoneNumberSuccess(): void
    {
        try {
            $req = new ValidatePhoneNumberReq();
            $req->setPhoneNumber('+49 151 12345678');

            $rsp = Utils::SDK()->validations()->validatePhoneNumber($req);
        } catch (\Throwable $e) {
            $this->fail(Utils::createExceptionFailMessage($e));
        }

        $this->assertTrue($rsp->getData()->getIsValid());
    }
}
