<?php

namespace Corbado\Model;

class AuthMethodsDataResponse
{
    const USER_EXISTS = 'exists';
    const USER_NOT_EXISTS = 'not_exists';
    const USER_BLOCKED = 'blocked';

    public string $status;
}
