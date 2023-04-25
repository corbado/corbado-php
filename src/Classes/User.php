<?php

namespace Corbado\Classes;

class User {
    private string $userID;
    private bool $authenticated;

    public function __construct(string $userID, bool $authenticated) {
        $this->userID = $userID;
        $this->authenticated = $authenticated;
    }

    public function getUserID() : string {
        return $this->userID;
    }

    public function isAuthenticated() : bool {
        return $this->authenticated;
    }
}