<?php

namespace Corbado\Classes;

use Corbado\Exceptions\Standard;

class User {
    private bool $authenticated;
    private string $userID;

    private string $email;

    private string $name;

    public function __construct(bool $authenticated, string $userID = '', string $email = '', string $name = '') {
        $this->authenticated = $authenticated;
        $this->userID = $userID;
        $this->email = $email;
        $this->name = $name;
    }

    public function isAuthenticated() : bool {
        return $this->authenticated;
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
    public function getName() : string {
        if ($this->isAuthenticated() === false) {
            throw new Standard('User is not authenticated');
        }

        return $this->name;
    }
}