<?php

namespace unit\Entities;

use Corbado\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testIsGuest(): void
    {
        $user = new UserEntity(false);
        $this->assertFalse($user->isAuthenticated());
    }

    public function testIsAuthenticated(): void
    {
        $user = new UserEntity(true);
        $this->assertTrue($user->isAuthenticated());
    }

    /**
     * @throws \Corbado\Exceptions\StandardException
     */
    public function testGetUserData(): void
    {
        $user = new UserEntity(true, 'id', 'name', 'email', 'phone-number', 'orig');
        $this->assertEquals('id', $user->getID());
        $this->assertEquals('name', $user->getName());
        $this->assertEquals('email', $user->getEmail());
        $this->assertEquals('phone-number', $user->getPhoneNumber());
        $this->assertEquals('orig', $user->getOrig());
    }
}
