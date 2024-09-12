<?php

namespace Corbado\Exceptions;

class ValidationException extends \Exception
{
    const CODE_JWT_GENERAL = 1;
    const CODE_JWT_ISSUER_MISMATCH = 2;
    const CODE_JWT_INVALID_DATA = 3;
    const CODE_JWT_INVALID_SIGNATURE = 4;
    const CODE_JWT_BEFORE = 5;
    const CODE_JWT_EXPIRED = 6;


    public function __construct(string $message, int $code) {
        parent::__construct($message, $code);
    }
}