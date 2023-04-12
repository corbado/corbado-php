<?php

namespace Corbado\Classes;

use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\EmailLinkSendReq;
use Corbado\Generated\Model\EmailLinkSendRsp;
use Corbado\Generated\Model\EmailLinkSendRspAllOfData;
use Corbado\Generated\Model\EmailLinksValidateReq;
use Corbado\Generated\Model\EmailLinkValidateRsp;
use GuzzleHttp\ClientInterface;
use JetBrains\PhpStorm\ArrayShape;

class EmailLinks
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    #[ArrayShape(['X-Corbado-ProjectID' => "string"])]
    private function generateHeaders(string $projectId): array
    {
        return ['X-Corbado-ProjectID' => $projectId];
    }

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

        $res = $this->client->request('POST', 'emailLinks', ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]);
        $json = Helper::jsonDecode($res->getBody()->getContents());

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

        $res = $this->client->request('PUT', 'emailLinks/' . $emailLinkID . '/validate', ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]);
        $json = Helper::jsonDecode($res->getBody()->getContents());

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
