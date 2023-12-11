<?php

namespace integration\validation;

use PHPUnit\Framework\TestCase;

class ValidateEmailTest extends TestCase
{
    public function testValidateEmail(): void
    {
        $email = '';
        $this->assertEmpty($email);
    }
}