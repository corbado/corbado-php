<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Classes\Helper;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\GenericRsp;
use Corbado\Generated\Model\SmsCodeSendReq;
use Corbado\Generated\Model\SmsCodeSendRsp;
use Corbado\Generated\Model\SmsCodeSendRspAllOfData;
use Corbado\Generated\Model\SmsCodeValidateReq;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class SMSCodes
{
    private ClientInterface $client;

    /**
     * @param string $projectId
     * @return string[]
     */
    private function generateHeaders(string $projectId): array
    {
        return ['X-Corbado-ProjectID' => $projectId];
    }

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws Http
     * @throws ClientExceptionInterface
     * @throws Standard
     */
    public function send(string $projectID, string $phoneNumber, string $remoteAddress, string $userAgent, bool $create = false, ?string $requestID = ''): SmsCodeSendRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($phoneNumber);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new SmsCodeSendReq();
        $request->setPhoneNumber($phoneNumber);
        $request->setRequestId($requestID);
        $request->setCreate($create);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                'smsCodes',
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $data = new SmsCodeSendRspAllOfData();
        $data->setSmsCodeId($json['data']['smsCodeID']);

        $response = new SmsCodeSendRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setData($data);

        return $response;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws Http
     * @throws ClientExceptionInterface
     * @throws GuzzleException
     * @throws Standard
     */
    public function validate(string $projectID, string $smsCodeID, string $smsCode, string $remoteAddress, string $userAgent, ?string $requestID = ''): GenericRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($smsCodeID);
        Assert::stringNotEmpty($smsCode);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new SmsCodeValidateReq();
        $request->setSmsCode($smsCode);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'PUT',
                'smsCodes/' . $smsCodeID . '/validate',
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        return Helper::hydrateResponse($json);
    }
}
