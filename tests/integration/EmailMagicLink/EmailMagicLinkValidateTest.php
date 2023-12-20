<?php

namespace integration\EmailMagicLink;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigurationException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\EmailLinksValidateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailMagicLinkValidateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailMagicLinkValidateValidationErrorEmptyToken(): void
    {
        $exception = null;

        try {
            $req = new EmailLinksValidateReq();
            $req->setToken('');

            Utils::SDK()->emailMagicLinks()->validate('eml-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEqualsCanonicalizing(['token: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailMagicLinkValidateValidationErrorInvalidID(): void
    {
        $exception = null;

        try {
            $req = new EmailLinksValidateReq();
            $req->setToken('fdfdsfdss1fdfdsfdss1');

            Utils::SDK()->emailMagicLinks()->validate('eml-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }
}
