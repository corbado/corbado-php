<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Helper;
use Corbado\Exceptions\Http;
use Corbado\Exceptions\Standard;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp;
use Corbado\Generated\Model\WebAuthnAuthenticateStartReq;
use Corbado\Generated\Model\WebAuthnAuthenticateStartRsp;
use Corbado\Generated\Model\WebAuthnCredentialReq;
use Corbado\Generated\Model\WebAuthnCredentialRsp;
use Corbado\Generated\Model\WebAuthnFinishReq;
use Corbado\Generated\Model\WebAuthnRegisterFinishRsp;
use Corbado\Generated\Model\WebAuthnRegisterStartReq;
use Corbado\Generated\Model\WebAuthnRegisterStartRsp;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use JetBrains\PhpStorm\ArrayShape;

class WebAuthn
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
     * @throws \Corbado\Exceptions\Assert
     * @throws Http
     * @throws ClientExceptionInterface
     * @throws Standard
     */
    public function registerStart(string $projectID, string $origin, string $credentialStatus, string $username, string $remoteAddress, string $userAgent, ?string $requestID = null): WebAuthnRegisterStartRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($origin);
        Assert::stringNotEmpty($credentialStatus);
        Assert::stringNotEmpty($username);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new WebAuthnRegisterStartReq();
        $request->setOrigin($origin);
        $request->setUsername($username);
        $request->setCredentialStatus($credentialStatus);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                'webauthn/register/start',
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $response = new WebAuthnRegisterStartRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setPublicKeyCredentialCreationOptions(
            $json['publicKeyCredentialCreationOptions']
        );
        $response->setStatus(
            $json['status']
        );

        return $response;
    }

    public function registerFinish(string $projectID, string $origin, string $publicKeyCredential, string $remoteAddress, string $userAgent, string $requestID = ''): WebAuthnRegisterFinishRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($origin);
        Assert::stringNotEmpty($publicKeyCredential);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $json = $this->finish(
            'webauthn/register/finish',
            $projectID,
            $origin,
            $publicKeyCredential,
            $remoteAddress,
            $userAgent,
            $requestID
        );

        $response = new WebAuthnRegisterFinishRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setUsername($json['username']);
        $response->setCredentialId($json['credentialID']);
        $response->setStatus($json['status']);

        return $response;
    }

    /**
     * @throws \Corbado\Exceptions\Assert
     * @throws ClientExceptionInterface
     * @throws Http
     * @throws Standard
     * @return array<string, mixed>
     */
    protected function finish(string $endPoint, string $projectID, string $origin, string $publicKeyCredential, string $remoteAddress, string $userAgent, string $requestID = ''): array
    {
        $request = new WebAuthnFinishReq();
        $request->setOrigin($origin);
        $request->setPublicKeyCredential($publicKeyCredential);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                $endPoint,
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        return $json;
    }

    /**
     * @throws \Corbado\Exceptions\Assert
     * @throws Http
     * @throws ClientExceptionInterface
     * @throws Standard
     */
    public function authenticateStart(string $projectID, string $origin, string $username, string $remoteAddress, string $userAgent, string $requestID = ''): WebAuthnAuthenticateStartRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($origin);
        Assert::stringNotEmpty($username);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new WebAuthnAuthenticateStartReq();
        $request->setOrigin($origin);
        $request->setRequestId($requestID);
        $request->setUsername($username);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                'webauthn/authenticate/start',
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $response = new WebAuthnAuthenticateStartRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setPublicKeyCredentialRequestOptions($json['publicKeyCredentialRequestOptions']);
        $response->setStatus($json['status']);

        return $response;
    }

    /**
     * @throws \Corbado\Exceptions\Assert
     * @throws Http
     * @throws ClientExceptionInterface
     * @throws Standard
     */
    public function authenticateFinish(string $projectID, string $origin, string $publicKeyCredential, string $remoteAddress, string $userAgent, string $requestID = ''): WebAuthnAuthenticateFinishRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($origin);
        Assert::stringNotEmpty($publicKeyCredential);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $json = $this->finish(
            'webauthn/authenticate/finish',
            $projectID,
            $origin,
            $publicKeyCredential,
            $remoteAddress,
            $userAgent,
            $requestID
        );

        $response = new WebAuthnAuthenticateFinishRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setUsername($json['username']);
        $response->setCredentialId($json['credentialID']);
        $response->setStatus($json['status']);

        return $response;
    }

    /**
     * @throws \Corbado\Exceptions\Assert
     * @throws Http
     * @throws ClientExceptionInterface
     * @throws Standard
     */
    public function credentialUpdate(string $credentialId, string $projectID, string $status, string $remoteAddress, string $userAgent, string $requestID = ''): WebAuthnCredentialRsp
    {
        Assert::stringNotEmpty($projectID);
        Assert::stringNotEmpty($status);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new WebAuthnCredentialReq();
        $request->setRequestId($requestID);
        $request->setStatus($status);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'PUT',
                'webauthn/credential/' . $credentialId,
                ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $response = new WebAuthnCredentialRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setStatus($json['status']);

        return $response;
    }
}
