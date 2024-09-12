<?php

namespace integration\User;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Model\UserUpdateReq;
use Corbado\Generated\Model\UserStatus;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserUpdateTest extends TestCase
{
    private static string $userID = '';

    /**
     * @throws ConfigException
     * @throws AssertException
     */
    public static function setupBeforeClass(): void
    {
        self::$userID = Utils::createUser();
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserUpdateValidationError(): void
    {
        $exception = null;

        try {
            $req = new UserUpdateReq();
            $req->setFullName(str_repeat('x', 256));

            Utils::SDK()->users()->update(self::$userID, $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['fullName: the length must be between 3 and 255'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserUpdateSuccess(): void
    {
        $req = new UserUpdateReq();
        $req->setFullName('Jane Doe');

        $user = Utils::SDK()->users()->update(self::$userID, $req);
        $this->assertEquals('Jane Doe', $user->getFullName());
    }
}
