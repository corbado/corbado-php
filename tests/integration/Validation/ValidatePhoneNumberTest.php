<?php

namespace integration\Validation;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class ValidatePhoneNumberTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testValidatePhoneNumberValidationError(): void
    {
        try {
            $req = new ValidatePhoneNumberReq();
            $req->setPhoneNumber('');

            Utils::SDK()->validations()->validatePhoneNumber($req);
        } catch (ServerException $e) {
            $this->assertEquals(400, $e->getHttpStatusCode());
            $this->assertEquals('phoneNumber: cannot be blank', $e->getValidationMessage());
        }
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testValidatePhoneNumberSuccess(): void
    {
        $req = new ValidatePhoneNumberReq();
        $req->setPhoneNumber('+49 151 12345678');

        $rsp = Utils::SDK()->validations()->validatePhoneNumber($req);
        $this->assertTrue($rsp->getData()->getIsValid());
    }
}
