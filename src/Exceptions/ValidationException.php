<?php

namespace Corbado\Exceptions;

class ValidationException extends \Exception
{
    const CODE_GENERAL = 1;
    const CODE_JWT_EXPIRED = 1;
    const CODE_JWT_ISSUER_MISMATCH = 2;

    public function __construct(string $message, int $code) {
        parent::__construct($message, $code);
    }
}