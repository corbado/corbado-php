<?php

namespace Corbado\Classes\Exceptions;

class ServerException extends \Exception
{
    private int $httpStatusCode;

    /**
     * @var array<mixed>
     */
    private array $requestData;
    private float $runtime;

    /**
     * @var array<mixed>
     */
    private array $error;

    /**
     * @param array<mixed> $requestData
     * @param array<mixed> $error
     */
    public function __construct(int $httpStatusCode, string $message, array $requestData, float $runtime, array $error)
    {
        parent::__construct($message, $httpStatusCode);

        $this->httpStatusCode = $httpStatusCode;
        $this->requestData = $requestData;
        $this->runtime = $runtime;
        $this->error = $error;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * @return array<mixed>
     */
    public function getRequestData(): array
    {
        return $this->requestData;
    }

    public function getRuntime(): float
    {
        return $this->runtime;
    }

    /**
     * @return array<mixed>
     */
    public function getError(): array
    {
        return $this->error;
    }
}
