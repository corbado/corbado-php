<?php

namespace Corbado\Helper;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\RequestData;

class Helper
{
    /**
     * JSON encode
     *
     * @param mixed $data
     * @return string
     * @throws StandardException
     */
    public static function jsonEncode(mixed $data): string
    {
        $json = \json_encode($data);
        if ($json === false || json_last_error() !== JSON_ERROR_NONE) {
            throw new StandardException('json_encode() failed: ' . json_last_error_msg());
        }

        return $json;
    }

    /**
     * JSON decode
     *
     * @param string $data
     * @return array<mixed>
     * @throws StandardException
     */
    public static function jsonDecode(string $data): array
    {
        Assert::stringNotEmpty($data);

        $json = \json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new StandardException('json_decode() failed: ' . json_last_error_msg());
        }

        return $json;
    }

    public static function isErrorHttpStatusCode(int $statusCode): bool
    {
        if ($statusCode < 300) {
            return false;
        }

        return true;
    }

    /**
     * @param array<mixed> $data
     * @throws AssertException
     * @throws ServerException
     */
    public static function throwServerExceptionOld(array $data): void
    {
        Assert::arrayKeysExist($data, ['httpStatusCode', 'message', 'requestData', 'runtime']);

        // Check for error data, not existent for 404 for example
        if (!array_key_exists('error', $data)) {
            $data['error'] = [];
        }

        throw new ServerException($data['httpStatusCode'], $data['message'], $data['requestData'], $data['runtime'], $data['error']);
    }

    /**
     * @throws StandardException
     */
    public static function convertToServerException(ApiException $e): ServerException
    {
        $body = $e->getResponseBody();
        if (!is_string($body)) {
            throw new StandardException('Response body is not a string');
        }

        $data = self::jsonDecode($body);

        return new ServerException($data['httpStatusCode'], $data['message'], $data['requestData'], $data['runtime'], $data['error']);
    }

    /**
     * @param array<mixed> $data
     * @return RequestData
     * @throws AssertException
     */
    public static function hydrateRequestData(array $data): RequestData
    {
        Assert::arrayKeysExist($data, ['requestID', 'link']);

        $requestData = new RequestData();
        $requestData->setRequestId($data['requestID']);
        $requestData->setLink($data['link']);

        return $requestData;
    }

    /**
     * @param array<mixed> $data
     * @throws AssertException
     */
    public static function hydrateResponse(array $data): GenericRsp
    {
        Assert::arrayKeysExist($data, ['httpStatusCode', 'message', 'requestData', 'runtime']);

        $requestData = self::hydrateRequestData($data['requestData']);

        $response = new GenericRsp();
        $response->setHttpStatusCode($data['httpStatusCode']);
        $response->setMessage($data['message']);
        $response->setRequestData($requestData);
        $response->setRuntime($data['runtime']);

        return $response;
    }
}
