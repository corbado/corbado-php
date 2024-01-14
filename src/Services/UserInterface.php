<?php

namespace Corbado\Services;

use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserCreateRsp;
use Corbado\Generated\Model\UserDeleteReq;
use Corbado\Generated\Model\UserGetRsp;
use Corbado\Generated\Model\UserListRsp;

interface UserInterface
{
    public function create(UserCreateReq $req): UserCreateRsp;
    public function delete(string $id, UserDeleteReq $req): GenericRsp;
    public function get(string $id, string $remoteAddr = '', string $userAgent = ''): UserGetRsp;

    /**
     * @param array<string> $filter
     */
    public function list(string $remoteAddr = '', string $userAgent = '', string $sort = '', array $filter = [], int $page = 1, int $pageSize = 10): UserListRsp;
}
