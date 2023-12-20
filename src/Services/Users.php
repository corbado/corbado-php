<?php

namespace Corbado\Services;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\UserApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserCreateRsp;
use Corbado\Generated\Model\UserDeleteReq;
use Corbado\Generated\Model\UserGetRsp;
use Corbado\Generated\Model\UserListRsp;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class Users implements UsersInterface
{
    private UserApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(UserApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function create(UserCreateReq $req): UserCreateRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->client->userCreate($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }

    /**
     * @throws StandardException
     * @throws AssertException
     * @throws ServerException
     */
    public function delete(string $id, UserDeleteReq $req): GenericRsp
    {
        Assert::stringNotEmpty($id);
        Assert::notNull($req);

        try {
            $rsp = $this->client->userDelete($id, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }

    /**
     * @throws StandardException
     * @throws AssertException
     * @throws ServerException
     */
    public function get(string $id, string $remoteAddr = '', string $userAgent = ''): UserGetRsp
    {
        Assert::stringNotEmpty($id);

        try {
            $rsp = $this->client->userGet($id, $remoteAddr, $userAgent);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }

    /**
     * @param array<string> $filter
     * @throws ServerException
     * @throws StandardException
     */
    public function list(string $remoteAddr = '', string $userAgent = '', string $sort = '', array $filter = [], int $page = 1, int $pageSize = 10): UserListRsp
    {
        try {
            $rsp = $this->client->userList($remoteAddr, $userAgent, $sort, $filter, $page, $pageSize);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
