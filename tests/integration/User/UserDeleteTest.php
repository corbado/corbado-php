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
            Utils::SDK()->users()->delete('usr-123456789');
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
        Utils::SDK()->users()->delete($userID);

        // We do not do any "real" asserts because in success case delete() returns nothing
        // and in case of error it throws an exception. The following assertTrue() is needed
        // to make PHPUnit happy (otherwise it is marked as a "risky" test).
        $this->assertTrue(true);
    }
}
