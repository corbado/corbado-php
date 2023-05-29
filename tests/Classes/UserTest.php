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
     * @throws \Corbado\Exceptions\Standard
     */
    public function testGetUserData() : void
        {
            $user = new User(true, 'user-id', 'email', 'name');
            $this->assertEquals('user-id', $user->getUserID());
            $this->assertEquals('email', $user->getEmail());
            $this->assertEquals('name', $user->getName());
        }
}
