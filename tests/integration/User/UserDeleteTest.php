<?php

namespace integration\User;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Generated\Model\UserDeleteReq;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserDeleteTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testUserDeleteNotFound(): void
    {
        try {
            Utils::SDK()->users()->delete('usr-123456789', new UserDeleteReq());
        } catch (ServerException $e) {
            $this->assertEquals(400, $e->getHttpStatusCode());
            $this->assertEquals('userID: does not exist', $e->getValidationMessage());
        }
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public function testUserDeleteSuccess(): void
    {
        $userID = Utils::createUser();

        $rsp = Utils::SDK()->users()->delete($userID, new UserDeleteReq());
        $this->assertEquals(200, $rsp->getHttpStatusCode());
    }
}
