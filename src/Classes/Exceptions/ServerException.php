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
        $this->httpStatusCode = $httpStatusCode;
        $this->requestData = $requestData;
        $this->runtime = $runtime;
        $this->error = $error;

        $message = $message . ' (HTTP status code: ' . $httpStatusCode . ', validation message: ' . implode('; ', $this->getValidationMessages()) . ')';

        parent::__construct($message, $httpStatusCode);
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

    public function getRequestID(): string
    {
        return $this->requestData['requestID'] ?? '';
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

    /**
     * @return array<string>
     */
    public function getValidationMessages(): array
    {
        if (empty($this->error)) {
            return [];
        }

        if (empty($this->error['validation'])) {
            return [];
        }

        $messages = [];
        foreach ($this->error['validation'] as $item) {
            $messages[] = $item['field'] . ': ' . $item['message'];
        }

        return $messages;
    }
}
