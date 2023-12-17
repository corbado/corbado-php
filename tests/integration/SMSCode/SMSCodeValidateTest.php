<?php

namespace integration\EmailCode;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeValidateReq;
use Corbado\Generated\Model\EmailLinksValidateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class SMSCodeValidateTest extends TestCase
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

            Utils::SDK()->emailCodes()->validate('emc-123456789', $req);
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

            Utils::SDK()->emailCodes()->validate('emc-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }
}
