<?php

namespace integration\EmailLink;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\EmailLinkSendReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailLinkSendTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailLinkSendValidationError(): void
    {
        $exception = null;

        try {
            $req = new EmailLinkSendReq();
            $req->setEmail('');
            $req->setRedirect('');

            Utils::SDK()->emailLinks()->send($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['email: cannot be blank', 'redirect: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailLinkSendSuccess(): void
    {
        $req = new EmailLinkSendReq();
        $req->setEmail(Utils::createRandomTestEmail());
        $req->setRedirect('https://example.com');
        $req->setCreate(true);

        $rsp = Utils::SDK()->emailLinks()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
