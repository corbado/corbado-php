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
        $res = null;
        $exception = null;

        try {
            $res = Utils::SDK()->validations()->validatePhoneNumber((new ValidatePhoneNumberReq())->setPhoneNumber(''));
        } catch (ServerException $e) {
            $exception = $e;
        } catch (\Throwable $e) {
            $this->fail('Unexpected exception: ' . $e->getMessage());
        }

        $this->assertNull($res);
        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEquals('phoneNumber: cannot be blank', $exception->getValidationMessage());
    }

    public function testValidatePhoneNumberSuccess(): void
    {
        try {
            $res = Utils::SDK()->validations()->validatePhoneNumber((new ValidatePhoneNumberReq())->setPhoneNumber('+49 151 12345678'));
        } catch (\Throwable $e) {
            $this->fail('Unexpected exception: ' . $e->getMessage());
        }

        $this->assertTrue($res->getData()->getIsValid());
    }
}
