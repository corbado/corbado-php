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
        $exception = null;

        try {
            $req = new ValidatePhoneNumberReq();
            $req->setPhoneNumber('');

            Utils::SDK()->validations()->validatePhoneNumber($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['phoneNumber: cannot be blank'], $exception->getValidationMessages());
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
