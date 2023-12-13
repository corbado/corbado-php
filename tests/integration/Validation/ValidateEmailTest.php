<?php

namespace integration\Validation;

use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\ValidateEmailReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class ValidateEmailTest extends TestCase
{
    public function testValidateEmailValidationError(): void
    {
        $rsp = null;
        $exception = null;

        try {
            $req = new ValidateEmailReq();
            $req->setEmail('');

            $rsp = Utils::SDK()->validations()->validateEmail($req);
        } catch (ServerException $e) {
            $exception = $e;
        } catch (\Throwable $e) {
            $this->fail(Utils::createExceptionFailMessage($e));
        }

        $this->assertNull($rsp);
        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEquals('email: cannot be blank', $exception->getValidationMessage());
    }

    public function testValidateEmailSuccess(): void
    {
        try {
            $req = new ValidateEmailReq();
            $req->setEmail('info@corbado.com');

            $rsp = Utils::SDK()->validations()->validateEmail($req);
        } catch (\Throwable $e) {
            $this->fail(Utils::createExceptionFailMessage($e));
        }

        $this->assertTrue($rsp->getData()->getIsValid());
    }
}
