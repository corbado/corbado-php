<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Classes\Helper;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\EmailLinkSendReq;
use Corbado\Generated\Model\EmailLinkSendRsp;
use Corbado\Generated\Model\EmailLinkSendRspAllOfData;
use Corbado\Generated\Model\EmailLinksValidateReq;
use Corbado\Generated\Model\EmailLinkValidateRsp;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class EmailLinks
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $projectId
     * @return string[]
     */
    private function generateHeaders(string $projectId): array
    {
        return ['X-Corbado-ProjectID' => $projectId];
    }

    /**
     * @throws Http
     * @throws GuzzleException
     * @throws ClientExceptionInterface
     * @throws Standard
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function send(string $projectID, string $email, string $templateName, string $redirect, string $remoteAddress, string $userAgent, bool $create = false, string $additionalPayload = "", ?string $requestID = ''): EmailLinkSendRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($email);
        Assert::stringNotEmpty($templateName);
        Assert::stringNotEmpty($redirect);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new EmailLinkSendReq();
        $request->setEmail($email);
        $request->setTemplateName($templateName);
        $request->setRedirect($redirect);
        $request->setRequestId($requestID);
        $request->setCreate($create);
        $request->setAdditionalPayload($additionalPayload);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                'emailLinks',
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $data = new EmailLinkSendRspAllOfData();
        $data->setEmailLinkId($json['data']['emailLinkID']);

        $response = new EmailLinkSendRsp();
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
     * @throws GuzzleException
     * @throws ClientExceptionInterface
     * @throws Standard
     */
    public function validate(string $projectID, string $emailLinkID, string $token, string $remoteAddress, string $userAgent, ?string $requestID = ''): EmailLinkValidateRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($emailLinkID);
        Assert::stringNotEmpty($token);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new EmailLinksValidateReq();
        $request->setToken($token);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'PUT',
                'emailLinks/' . $emailLinkID . '/validate',
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $response = new EmailLinkValidateRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setAdditionalPayload($json['additionalPayload']);

        return $response;
    }
}
