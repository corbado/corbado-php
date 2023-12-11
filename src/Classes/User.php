<?php

namespace Corbado\Classes;

use Corbado\Classes\Exceptions\StandardException;

class User
{
    private bool $authenticated;
    private string $id;
    private string $name;
    private string $email;
    private string $phoneNumber;

    public function __construct(bool $authenticated, string $id = '', string $name = '', string $email = '', string $phoneNumber = '')
    {
        $this->authenticated = $authenticated;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
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
}
