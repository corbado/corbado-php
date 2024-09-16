<?php

namespace Corbado\Services;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\IdentifiersApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\Identifier;
use Corbado\Generated\Model\IdentifierCreateReq;
use Corbado\Generated\Model\IdentifierUpdateReq;
use Corbado\Generated\Model\IdentifierList;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class IdentifierService implements IdentifierInterface
{
    private IdentifiersApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(IdentifiersApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function create(string $userID, IdentifierCreateReq $req): Identifier
    {
        Assert::notNull($req);

        try {
            $identifier = $this->client->identifierCreate($userID, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($identifier instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $identifier;
    }

    /**
     * @throws StandardException
     * @throws AssertException
     * @throws ServerException
     */
    public function delete(string $userID, string $identifierID): void
    {
        Assert::stringNotEmpty($userID);
        Assert::stringNotEmpty($identifierID);

        try {
            // identifierDelete() returns a "GenericRsp" (see OpenAPI specs) if the
            // deletion was successful. But it does not contain any data so we
            // "swallow" it here (delete() returns void). A better approach would
            // be that the Backend API V2 returns 204 No Content with no body but
            // this was too much work to change for now.
            $this->client->identifierDelete($userID, $identifierID);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }
    }

    /**
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function update(string $userID, string $identifierID, IdentifierUpdateReq $req): Identifier
    {
        Assert::stringNotEmpty($userID);
        Assert::stringNotEmpty($identifierID);
        Assert::notNull($req);

        try {
            $identifier = $this->client->identifierUpdate($userID, $identifierID, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($identifier instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $identifier;
    }

    /**
     * @param array<string> $filter
     * @throws ServerException
     * @throws StandardException
     */
    public function list(string $sort = '', array $filter = [], int $page = 1, int $pageSize = 10): IdentifierList
    {
        try {
            $rsp = $this->client->identifierList($sort, $filter, $page, $pageSize);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}