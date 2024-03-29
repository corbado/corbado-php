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
        $this->assertEquals(404, $exception->getHttpStatusCode());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserGetSuccess(): void
    {
        $userID = Utils::createUser();

        $rsp = Utils::SDK()->users()->get($userID);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
