<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Classes\Exceptions\StandardException;
use Corbado\Classes\Helper;
use Corbado\Generated\Api\UserApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserCreateRsp;
use Corbado\Generated\Model\UserDeleteReq;
use Corbado\Generated\Model\UserGetRsp;

class Users implements UsersInterface
{
    private UserApi $api;

    /**
     * @throws AssertException
     */
    public function __construct(UserApi $api)
    {
        Assert::notNull($api);
        $this->api = $api;
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
            $rsp = $this->api->userCreate($req);
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
    public function delete(string $id, UserDeleteReq $req) : GenericRsp
    {
        Assert::stringNotEmpty($id);
        Assert::notNull($req);

        try {
            $rsp = $this->api->userDelete($id, $req);
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
    public function get(string $id, string $remoteAddr = '', string $userAgent = '') : UserGetRsp
    {
        Assert::stringNotEmpty($id);

        try {
            $rsp = $this->api->userGet($id, $remoteAddr, $userAgent);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
