<?php

namespace integration\Validation;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
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
        $exception = null;

        try {
            $req = new ValidateEmailReq();
            $req->setEmail('');

            Utils::SDK()->validations()->validateEmail($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['email: cannot be blank'], $exception->getValidationMessages());
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
