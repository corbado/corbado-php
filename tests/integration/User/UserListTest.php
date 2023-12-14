<?php

namespace integration\User;

use _PHPStan_f73a165d5\Nette\Neon\Exception;
use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserListTest extends TestCase
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
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
        $this->assertEquals('sort: Invalid order direction \'bar\'', $exception->getValidationMessage());
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
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
