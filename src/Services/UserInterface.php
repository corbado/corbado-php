<?php

namespace Corbado\Services;

use Corbado\Generated\Model\User;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserUpdateReq;

interface UserInterface
{
    public function create(UserCreateReq $req): User;
    public function delete(string $userID): void;
    public function get(string $userID): User;
    public function update(string $userID, UserUpdateReq $req): User;
}
