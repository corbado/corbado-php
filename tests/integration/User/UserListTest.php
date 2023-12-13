<?php

namespace integration\User;

use Corbado\Classes\Exceptions\ServerException;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserListTest extends TestCase
{
    public function testUserListValidationError(): void
    {
        $rsp = null;
        $exception = null;

        try {
            $rsp = Utils::SDK()->users()->list('', '', 'foo:bar');
        } catch (ServerException $e) {
            $exception = $e;
        } catch (\Throwable $e) {
            $this->fail(Utils::createExceptionFailMessage($e));
        }

        $this->assertNull($rsp);
        $this->assertNotNull($exception);
        $this->assertEquals(422, $exception->getHttpStatusCode());
        $this->assertEquals('sort: Invalid order direction \'bar\'', $exception->getValidationMessage());
    }

    public function testUserListSuccess(): void
    {
        try {
            $userID = Utils::createUser();

            $rsp = Utils::SDK()->users()->list();

            $found = false;
            foreach ($rsp->getData()->getUsers() as $user) {
                if ($user->getId() === $userID) {
                    $found = true;
                    break;
                }
            }

            $this->assertTrue($found);
        } catch (\Throwable $e) {
            $this->fail(Utils::createExceptionFailMessage($e));
        }
    }
}
