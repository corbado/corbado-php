<?php

namespace Corbado\Classes;

use Corbado\Exceptions\Http;
use Corbado\Exceptions\Standard;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\RequestData;

class Helper
{

    /**
     * @throws Standard
     */
    public static function jsonEncode(mixed $data): string
    {
        $json = \json_encode($data);
        if ($json === false) {
            throw new Standard('json_encode() failed: ' . json_last_error_msg());
        }

        return $json;
    }

    /**
     * @throws \Corbado\Exceptions\Assert
     * @throws Standard
     * @return array<mixed>
     */
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

    /**
     * @throws Http
     * @throws \Corbado\Exceptions\Assert
     * @param array<mixed> $data
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
     * @throws \Corbado\Exceptions\Assert
     * @param array<mixed> $data
     * @return RequestData
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
     * @throws \Corbado\Exceptions\Assert
     * @param array<mixed> $data
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
