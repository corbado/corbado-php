<?php

namespace integration\validation;

use integration\Utils;
use PHPUnit\Framework\TestCase;

class ValidateEmailTest extends TestCase
{
    public function testValidateEmail(): void
    {
        $res = Utils::SDK()->validations()->validateEmail(null);
        $this->assertTrue($res);
    }
}