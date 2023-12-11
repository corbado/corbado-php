<?php

namespace Corbado\Classes\Apis;

use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserCreateRsp;
use Corbado\Generated\Model\UserDeleteReq;
use Corbado\Generated\Model\UserGetRsp;

interface UsersInterface
{
    public function create(UserCreateReq $req): UserCreateRsp;
    public function delete(string $id, UserDeleteReq $req): GenericRsp;
    public function get(string $id, string $remoteAddr = '', string $userAgent = ''): UserGetRsp;
}
