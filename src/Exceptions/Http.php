<?php

namespace Corbado\Exceptions;

use Throwable;

class Http extends \Exception {
    private int $httpStatusCode;
    private array $requestData;
    private float $runtime;
    private array $error;

    public function __construct(int $httpStatusCode, string $message, array $requestData, float $runtime, array $error)
    {
        parent::__construct($message, $httpStatusCode);

        $this->httpStatusCode = $httpStatusCode;
        $this->requestData = $requestData;
        $this->runtime = $runtime;
        $this->error = $error;
    }

    public function getHttpStatusCode(): int {
        return $this->httpStatusCode;
    }

    public function getRequestData(): array {
        return $this->requestData;
    }

    public function getRuntime(): float {
        return $this->runtime;
    }

    public function getError(): array {
        return $this->error;
    }
}