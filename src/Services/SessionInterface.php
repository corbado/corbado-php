<?php

namespace Corbado\Services;
use Corbado\Entities\UserEntity;

interface SessionInterface
{
    public function getShortSessionValue(): string;
    public function validateShortSessionValue(string $value): ?\stdClass;
    public function getLastShortSessionValidationResult(): string;
    public function getCurrentUser(): UserEntity;
}
