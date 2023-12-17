<?php

namespace integration\EmailLink;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\EmailLinksValidateReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class EmailLinkValidateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailLinkValidateValidationErrorEmptyToken(): void
    {
        $exception = null;

        try {
            $req = new EmailLinksValidateReq();
            $req->setToken('');

            Utils::SDK()->emailLinks()->validate('eml-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(['token: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testEmailLinkValidateValidationErrorInvalidID(): void
    {
        $exception = null;

        try {
            $req = new EmailLinksValidateReq();
            $req->setToken('fdfdsfdss1fdfdsfdss1');

            Utils::SDK()->emailLinks()->validate('eml-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }
}
