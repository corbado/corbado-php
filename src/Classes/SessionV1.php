<?php

namespace Corbado\Classes;

use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\SessionTokenVerifyReq;
use Corbado\Generated\Model\SessionTokenVerifyRsp;
use Corbado\Generated\Model\SessionTokenVerifyRspAllOfData;
use Firebase\JWT\CachedKeySet;
use Firebase\JWT\JWT;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Request;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class SessionV1
{
    private ClientInterface $client;

    /**
     * Constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Verifies a session token
     *
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws Http
     * @throws GuzzleException
     * @throws Standard
     * @throws ClientExceptionInterface
     * @deprecated
     */
    public function verify(string $sessionToken, string $remoteAddress, string $userAgent, string $requestID = ''): SessionTokenVerifyRsp
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
                '/v1/sessions/verify',
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
