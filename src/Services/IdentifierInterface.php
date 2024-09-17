<?php

namespace Corbado\Services;

use Corbado\Generated\Model\Identifier;
use Corbado\Generated\Model\IdentifierCreateReq;
use Corbado\Generated\Model\IdentifierList;
use Corbado\Generated\Model\IdentifierUpdateReq;

interface IdentifierInterface
{
    public function create(string $userID, IdentifierCreateReq $req): Identifier;
    public function delete(string $userID, string $identifierID): void;
    public function update(string $userID, string $identifierID, IdentifierUpdateReq $req): Identifier;

    /**
     * @param array<string> $filter
     */
    public function list(string $sort = '', array $filter = [], int $page = 1, int $pageSize = 10): IdentifierList;
}
