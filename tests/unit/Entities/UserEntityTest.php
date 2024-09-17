<?php

namespace unit\Entities;

use Corbado\Entities\UserEntity;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testGetUserData(): void
    {
        $user = new UserEntity('id', 'name', 'email', 'phone-number', 'orig');
        $this->assertEquals('id', $user->getID());
        $this->assertEquals('name', $user->getName());
        $this->assertEquals('email', $user->getEmail());
        $this->assertEquals('phone-number', $user->getPhoneNumber());
        $this->assertEquals('orig', $user->getOrig());
    }
}
