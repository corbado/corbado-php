<?php

namespace Corbado\Classes;

use Corbado\Exceptions\Standard;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\RequestData;

class Helper
{

    public static function jsonEncode($data): string
    {
        $json = \json_encode($data);
        if ($json === false) {
            throw new Standard('json_encode() failed: ' . json_last_error_msg());
        }

        return $json;
    }

    public static function jsonDecode(string $data): array
    {
        Assert::stringNotEmpty($data);

        $json = \json_decode($data, true);
        if ($json === false) {
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

    public static function throwException(array $data)
    {
        Assert::arrayKeysExist($data, ['httpStatusCode', 'message', 'requestData', 'runtime']);

        // Check for error data, not existent for 404 for example
        if (!array_key_exists('error', $data)) {
           $data['error'] = [];
        }

        throw new Standard($data['httpStatusCode'], $data['message'], $data['requestData'], $data['runtime'], $data['error']);
    }

    public static function hydrateRequestData(array $data): RequestData
    {
        Assert::arrayKeysExist($data, ['requestID', 'link']);

        $requestData = new RequestData();
        $requestData->setRequestId($data['requestID']);
        $requestData->setLink($data['link']);

        return $requestData;
    }

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
