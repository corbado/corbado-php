<?php

namespace Corbado\Services;

use Corbado\Entities\UserEntity;

interface SessionInterface
{
    public function validateToken(string $shortSession): UserEntity;
}
