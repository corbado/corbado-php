<?php

namespace integration\User;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserStatus;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserCreateTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserCreateValidationError(): void
    {
        $exception = null;

        try {
            $req = new UserCreateReq();

            Utils::SDK()->users()->create($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['status: cannot be blank'], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserCreateSuccess(): void
    {
        $req = new UserCreateReq();
        // @phpstan-ignore-next-line
        $req->setStatus(UserStatus::ACTIVE);

        $user = Utils::SDK()->users()->create($req);
        $this->assertTrue($user->getUserId() != '');
    }
}
