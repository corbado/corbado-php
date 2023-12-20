<?php

namespace Corbado\Webhook\Entities;

class AuthMethodsDataResponse
{
    public const USER_EXISTS = 'exists';
    public const USER_NOT_EXISTS = 'not_exists';
    public const USER_BLOCKED = 'blocked';

    public string $status;
}
