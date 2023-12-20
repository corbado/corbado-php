<?php

namespace integration\EmailCode;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeValidateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailCodeValidateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailCodeValidateValidationErrorEmptyCode(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeValidateReq();
            $req->setCode('');

            Utils::SDK()->emailOTPs()->validate('emc-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['code: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailCodeValidateValidationErrorInvalidID(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeValidateReq();
            $req->setCode('123456');

            Utils::SDK()->emailOTPs()->validate('emc-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }
}
