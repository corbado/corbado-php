<?php

namespace Corbado\Services;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\UsersApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\User;
use Corbado\Generated\Model\UserUpdateReq;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class UserService implements UserInterface
{
    private UsersApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(UsersApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function create(UserCreateReq $req): User
    {
        Assert::notNull($req);

        try {
            $user = $this->client->userCreate($req);
        } catch (ApiException $e) {
            var_dump($e);
            throw Helper::convertToServerException($e);
        }

        if ($user instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $user;
    }

    /**
     * @throws StandardException
     * @throws AssertException
     * @throws ServerException
     */
    public function delete(string $userID): void
    {
        Assert::stringNotEmpty($userID);

        try {
            // userDelete() returns a "GenericRsp" (see OpenAPI specs) if the
            // deletion was successful. But it does not contain any data so we
            // "swallow" it here (delete() returns void). A better approach would
            // be that the Backend API V2 returns 204 No Content with no body but
            // this was too much work to change for now.
            $this->client->userDelete($userID);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }
    }

    /**
     * @throws StandardException
     * @throws AssertException
     * @throws ServerException
     */
    public function get(string $userID): User
    {
        Assert::stringNotEmpty($userID);

        try {
            $user = $this->client->userGet($userID);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($user instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $user;
    }

    /**
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function update(string $userID, UserUpdateReq $req): User
    {
        Assert::stringNotEmpty($userID);
        Assert::notNull($req);

        try {
            $user = $this->client->userUpdate($userID, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($user instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $user;
    }
}
