<?php

namespace Corbado\Exceptions;

class ValidationException extends \Exception
{
    public const CODE_JWT_GENERAL = 1;
    public const CODE_JWT_ISSUER_MISMATCH = 2;
    public const CODE_JWT_INVALID_DATA = 3;
    public const CODE_JWT_INVALID_SIGNATURE = 4;
    public const CODE_JWT_BEFORE = 5;
    public const CODE_JWT_EXPIRED = 6;

    public const CODE_JWT_ISSUER_EMPTY = 7;

    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}
