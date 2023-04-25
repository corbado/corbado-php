<?php

namespace Corbado\Classes;

use Corbado\Exceptions\Standard;

class User {
    private bool $authenticated;
    private string $userID;

    /**
     * @throws \Corbado\Exceptions\Assert
     */
    public function __construct(bool $authenticated, string $userID) {
        Assert::stringNotEmpty($userID);

        $this->authenticated = $authenticated;
        $this->userID = $userID;

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


}