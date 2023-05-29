<?php

namespace Corbado\Classes;

use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\RequestData;

class Helper
{
    /**
     * JSON encode
     *
     * @param mixed $data
     * @return string
     * @throws Standard
     */
    public static function jsonEncode(mixed $data): string
    {
        $json = \json_encode($data);
        if ($json === false || json_last_error() !== JSON_ERROR_NONE) {
            throw new Standard('json_encode() failed: ' . json_last_error_msg());
        }

        return $json;
    }

    /**
     * JSON decode
     *
     * @param string $data
     * @return array<mixed>
     * @throws Standard
     */
    public static function jsonDecode(string $data): array
    {
        Assert::stringNotEmpty($data);

        $json = \json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Standard('json_decode() failed: ' . json_last_error_msg());
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
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws Http
     */
    public static function throwException(array $data) : void
    {
        Assert::arrayKeysExist($data, ['httpStatusCode', 'message', 'requestData', 'runtime']);

        // Check for error data, not existent for 404 for example
        if (!array_key_exists('error', $data)) {
           $data['error'] = [];
        }

        throw new Http($data['httpStatusCode'], $data['message'], $data['requestData'], $data['runtime'], $data['error']);
    }

    /**
     * @param array<mixed> $data
     * @return RequestData
     *@throws \Corbado\Classes\Exceptions\Assert
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
     * @throws \Corbado\Classes\Exceptions\Assert
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
