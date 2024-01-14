<?php

namespace integration\EmailMagicLink;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailLinkSendReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailMagicLinkSendTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailMagicLinkSendValidationError(): void
    {
        $exception = null;

        try {
            $req = new EmailLinkSendReq();
            $req->setEmail('');
            $req->setRedirect('');

            Utils::SDK()->emailMagicLinks()->send($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['email: cannot be blank', 'redirect: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testEmailMagicLinkSendSuccess(): void
    {
        $req = new EmailLinkSendReq();
        $req->setEmail(Utils::createRandomTestEmail());
        $req->setRedirect('https://example.com');
        $req->setCreate(true);

        $rsp = Utils::SDK()->emailMagicLinks()->send($req);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
