<?php

namespace Corbado\Entities;

use Corbado\Exceptions\StandardException;

class UserEntity
{
    private string $id;
    private string $name;
    private string $email;
    private string $phoneNumber;
    private string $orig;

    public function __construct(string $id = '', string $name = '', string $email = '', string $phoneNumber = '', string $orig = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->orig = $orig;
    }

    public function getID(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getOrig(): string
    {
        return $this->orig;
    }
}
