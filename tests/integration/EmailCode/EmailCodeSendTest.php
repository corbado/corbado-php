<?php

namespace integration\EmailCode;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailCodeSendReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailCodeSendTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailCodeSendValidationError(): void
    {
        $exception = null;

        try {
            $req = new EmailCodeSendReq();
            $req->setEmail('');

            Utils::SDK()->emailOTPs()->send($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['email: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailCodeSendSuccess(): void
    {
        $req = new EmailCodeSendReq();
        $req->setEmail(Utils::createRandomTestEmail());
        $req->setCreate(true);

        $rsp = Utils::SDK()->emailOTPs()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
