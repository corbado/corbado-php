<?php

namespace integration\User;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\UserDeleteReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserGetTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testUserGetNotFound(): void
    {
        try {
            Utils::SDK()->users()->get('usr-123456789');
        } catch (ServerException $e) {
            $this->assertEquals(404, $e->getHttpStatusCode());
        }
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testUserGetSuccess(): void
    {
        $userID = Utils::createUser();

        $rsp = Utils::SDK()->users()->get($userID);
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
