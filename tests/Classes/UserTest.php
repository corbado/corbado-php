<?php

use Corbado\Classes\User;
use PHPUnit\Framework\TestCase;

class UserTest  extends TestCase {
        public function testIsGuest() : void
        {
            $user = new User(false);
            $this->assertFalse($user->isAuthenticated());
        }

        public function testIsAuthenticated() : void
        {
            $user = new User(true);
            $this->assertTrue($user->isAuthenticated());
        }

    /**
     * @throws \Corbado\Classes\Exceptions\StandardException
     */
    public function testGetUserData() : void
        {
            $user = new User(true, 'id', 'name', 'email', 'phone-number');
            $this->assertEquals('id', $user->getID());
            $this->assertEquals('name', $user->getName());
            $this->assertEquals('email', $user->getEmail());
            $this->assertEquals('phone-number', $user->getPhoneNumber());
        }
}
