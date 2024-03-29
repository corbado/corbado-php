<?php

namespace integration\User;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\UserDeleteReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserDeleteTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserDeleteNotFound(): void
    {
        $exception = null;

        try {
            Utils::SDK()->users()->delete('usr-123456789', new UserDeleteReq());
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['userID: does not exist'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserDeleteSuccess(): void
    {
        $userID = Utils::createUser();

        $rsp = Utils::SDK()->users()->delete($userID, new UserDeleteReq());
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
