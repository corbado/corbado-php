<?php

namespace Corbado\Services;

use Corbado\Generated\Model\Identifier;
use Corbado\Generated\Model\IdentifierCreateReq;
use Corbado\Generated\Model\IdentifierList;
use Corbado\Generated\Model\IdentifierStatus;
use Corbado\Generated\Model\IdentifierType;
use Corbado\Generated\Model\IdentifierUpdateReq;

interface IdentifierInterface
{
    public function create(string $userID, IdentifierCreateReq $req): Identifier;
    public function delete(string $userID, string $identifierID): void;
    public function update(string $userID, string $identifierID, IdentifierUpdateReq $req): Identifier;

    /**
     * @param string $userID
     * @param string $identifierID
     * @param IdentifierStatus $status
     * @return Identifier
     */
    public function updateStatus(string $userID, string $identifierID, string $status): Identifier;

    /**
     * @param array<string> $filter
     */
    public function list(string $sort = '', array $filter = [], int $page = 1, int $pageSize = 10): IdentifierList;

    /**
     * @param string $value
     * @param IdentifierType $type
     * @param string $sort
     * @param int $page
     * @param int $pageSize
     * @return IdentifierList
     */
    public function listByValueAndType(string $value, string $type, string $sort = '', int $page = 1, int $pageSize = 10): IdentifierList;

    /**
     * @param string $userId
     * @param string $sort
     * @param int $page
     * @param int $pageSize
     * @return IdentifierList
     */
    public function listByUserId(string $userId, string $sort = '', int $page = 1, int $pageSize = 10): IdentifierList;

    /**
     * @param string $userId
     * @param IdentifierType $type
     * @param string $sort
     * @param int $page
     * @param int $pageSize
     * @return IdentifierList
     */
    public function listByUserIdAndType(string $userId, string $type, string $sort = '', int $page = 1, int $pageSize = 10): IdentifierList;
}
