<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Classes\Helper;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\SessionTokenVerifyReq;
use Corbado\Generated\Model\SessionTokenVerifyRsp;
use Corbado\Generated\Model\SessionTokenVerifyRspAllOfData;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class Widget
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws Http
     * @throws GuzzleException
     * @throws Standard
     */
    public function sessionVerify(string $sessionToken, string $remoteAddress, string $userAgent, string $requestID = ''): SessionTokenVerifyRsp
    {
        Assert::stringNotEmpty($sessionToken);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new SessionTokenVerifyReq();
        $request->setToken($sessionToken);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                '/v1/smsCodes',
                ['body' => Helper::jsonEncode($request->jsonSerialize())]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $data = new SessionTokenVerifyRspAllOfData();
        $data->setUserId($json['data']['userID']);
        $data->setUserData($json['data']['userData']);

        $response = new SessionTokenVerifyRsp();
        $response->setData($data);

        return $response;
    }
}