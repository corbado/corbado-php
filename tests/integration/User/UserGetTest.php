<?php

namespace integration\User;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserGetTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserGetNotFound(): void
    {
        $exception = null;

        try {
            Utils::SDK()->users()->get('usr-123456789');
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
    public function testUserGetSuccess(): void
    {
        $userID = Utils::createUser();

        $user = Utils::SDK()->users()->get($userID);
        $this->assertNotNull($user);
    }
}
