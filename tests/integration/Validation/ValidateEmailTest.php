<?php

namespace integration\Validation;

use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\ValidateEmailReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class ValidateEmailTest extends TestCase
{
    /**
     */
    public function testValidateEmailValidationError(): void
    {
        $res = null;
        $exception = null;

        try {
            $res = Utils::SDK()->validations()->validateEmail((new ValidateEmailReq())->setEmail(''));
        } catch (ServerException $e) {
            $exception = $e;
        } catch (\Throwable $e) {
            $this->fail('Unexpected exception: ' . $e->getMessage());
        }

        $this->assertNull($res);
        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEquals('email: cannot be blank', $exception->getValidationMessage());
    }

    public function testValidateEmailSuccess(): void
    {
        try {
            $res = Utils::SDK()->validations()->validateEmail((new ValidateEmailReq())->setEmail('info@corbado.com'));
        } catch (\Throwable $e) {
            $this->fail('Unexpected exception: ' . $e->getMessage());
        }

        $this->assertTrue($res->getData()->getIsValid());
    }
}
