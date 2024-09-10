<?php

namespace Corbado\Entities;

use Corbado\Exceptions\StandardException;

class UserEntity
{
    private bool $authenticated;
    private string $id;
    private string $name;
    private string $email;
    private string $phoneNumber;
    private string $orig;

    public function __construct(bool $authenticated, string $id = '', string $name = '', string $email = '', string $phoneNumber = '', string $orig = '')
    {
        $this->authenticated = $authenticated;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->orig = $orig;
    }

    public function isAuthenticated(): bool
    {
        return $this->authenticated;
    }

    /**
     * @throws StandardException
     */
    public function getID(): string
    {
        if ($this->isAuthenticated() === false) {
            throw new StandardException('User is not authenticated');
        }

        return $this->id;
    }

    /**
     * @throws StandardException
     */
    public function getName(): string
    {
        if ($this->isAuthenticated() === false) {
            throw new StandardException('User is not authenticated');
        }

        return $this->name;
    }

    /**
     * @throws StandardException
     */
    public function getEmail(): string
    {
        if ($this->isAuthenticated() === false) {
            throw new StandardException('User is not authenticated');
        }

        return $this->email;
    }

    /**
     * @throws StandardException
     */
    public function getPhoneNumber(): string
    {
        if ($this->isAuthenticated() === false) {
            throw new StandardException('User is not authenticated');
        }

        return $this->phoneNumber;
    }

    /**
     * @throws StandardException
     */
    public function getOrig(): string
    {
        if ($this->isAuthenticated() === false) {
            throw new StandardException('User is not authenticated');
        }

        return $this->orig;
    }
}
