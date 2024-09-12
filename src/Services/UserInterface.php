<?php

namespace Corbado\Services;

use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\User;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserUpdateReq;

interface UserInterface
{
    public function create(UserCreateReq $req): User;
    public function delete(string $id): void;
    public function get(string $id): User;
    public function update(string $id, UserUpdateReq $req): User;
}
