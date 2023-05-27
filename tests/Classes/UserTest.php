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
}
