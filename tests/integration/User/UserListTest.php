<?php

namespace integration\User;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Exceptions\ServerException;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserListTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserListValidationError(): void
    {
        $exception = null;

        try {
            Utils::SDK()->users()->list('', '', 'foo:bar');
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(422, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['sort: Invalid order direction \'bar\''], $exception->getValidationMessages());
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public function testUserListSuccess(): void
    {
        $userID = Utils::createUser();
        $rsp = Utils::SDK()->users()->list('', '', 'created:desc');

        $found = false;
        foreach ($rsp->getData()->getUsers() as $user) {
            if ($user->getId() === $userID) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found);
    }
}
