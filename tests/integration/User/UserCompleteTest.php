<?php

namespace integration\User;

use Corbado\Exceptions\ServerException;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserUpdateReq;
use Corbado\Generated\Model\UserStatus;
use integration\Utils;
use PHPUnit\Framework\TestCase;

class UserCompleteTest extends TestCase
{
    public function testUserComplete(): void
    {
        $exception = null;

        // Test getting a non-existent user
        try {
            Utils::SDK()->users()->get('usr-123456789');
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['xxx userID: does not exist'], $exception->getValidationMessages());

        // Test deleting a non-existent user
        try {
            Utils::SDK()->users()->delete('usr-123456789');
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['userID: does not exist'], $exception->getValidationMessages());

        // Test updating a non-existent user
        try {
            $req = new UserUpdateReq();

            Utils::SDK()->users()->update('usr-123456789', $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['userID: does not exist'], $exception->getValidationMessages());

        // Test creating a user with invalid data
        try {
            $req = new UserCreateReq();

            Utils::SDK()->users()->create($req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['status: cannot be blank'], $exception->getValidationMessages());

        // Test creating a user with valid data
        $req = new UserCreateReq();
        // @phpstan-ignore-next-line
        $req->setStatus(UserStatus::ACTIVE);

        $user = Utils::SDK()->users()->create($req);
        $this->assertTrue($user->getUserId() != '');

        $existingUserID = $user->getUserId();

        // Test getting an existing user
        $user = Utils::SDK()->users()->get($existingUserID);
        $this->assertNotNull($user);

        // Test updating an existing user with invalid data
        try {
            $req = new UserUpdateReq();
            $req->setFullName(str_repeat('x', 256));

            Utils::SDK()->users()->update($existingUserID, $req);
        } catch (ServerException $e) {
            $exception = $e;
        }

        $this->assertNotNull($exception);
        $this->assertEquals(400, $exception->getHttpStatusCode());
        $this->assertEqualsCanonicalizing(['fullName: the length must be between 3 and 255'], $exception->getValidationMessages());

        // Test updating an existing user with valid data
        $req = new UserUpdateReq();
        $req->setFullName('Jane Doe');

        $user = Utils::SDK()->users()->update($existingUserID, $req);
        $this->assertEquals('Jane Doe', $user->getFullName());

        // Test deleting an existing user
        Utils::SDK()->users()->delete($existingUserID);
    }
}
