<?php

namespace integration\Validation;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\ValidateEmailReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class ValidateEmailTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testValidateEmailValidationError(): void
    {
        try {
            $req = new ValidateEmailReq();
            $req->setEmail('');

            Utils::SDK()->validations()->validateEmail($req);
        } catch (ServerException $e) {
            $this->assertEquals(400, $e->getHttpStatusCode());
            $this->assertEquals('email: cannot be blank', $e->getValidationMessage());
        }
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testValidateEmailSuccess(): void
    {
        $req = new ValidateEmailReq();
        $req->setEmail('info@corbado.com');

        $rsp = Utils::SDK()->validations()->validateEmail($req);
        $this->assertTrue($rsp->getData()->getIsValid());
    }
}
