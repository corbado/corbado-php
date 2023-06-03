<?php

namespace Corbado\Classes;

use Corbado\Classes\Exceptions\Standard;

class User {
    private bool $authenticated;
    private string $userID;

    private string $name;

    private string $email;

    private string $phoneNumber;

    public function __construct(bool $authenticated, string $userID = '', string $name = '', string $email = '', string $phoneNumber = '') {
        $this->authenticated = $authenticated;
        $this->userID = $userID;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function isAuthenticated() : bool {
        return $this->authenticated;
    }

    /**
     * @throws Standard
     */
    public function getName() : string {
        if ($this->isAuthenticated() === false) {
            throw new Standard('User is not authenticated');
        }

        return $this->name;
    }

    /**
     * @throws Standard
     */
    public function getUserID() : string {
        if ($this->isAuthenticated() === false) {
            throw new Standard('User is not authenticated');
        }

        return $this->userID;
    }

    /**
     * @throws Standard
     */
    public function getEmail() : string {
        if ($this->isAuthenticated() === false) {
            throw new Standard('User is not authenticated');
        }

        return $this->email;
    }

    /**
     * @throws Standard
     */
    public function getPhoneNumber() : string {
        if ($this->isAuthenticated() === false) {
            throw new Standard('User is not authenticated');
        }

        return $this->phoneNumber;
    }
}