<?php

namespace Corbado\Services;

use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\User;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserCreateRsp;
use Corbado\Generated\Model\UserDeleteReq;
use Corbado\Generated\Model\UserGetRsp;
use Corbado\Generated\Model\UserListRsp;

interface UserInterface
{
    public function create(UserCreateReq $req): User;
    public function delete(string $id): void;
    public function get(string $id): User;
}
