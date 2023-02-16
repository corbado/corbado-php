<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Corbado\Classes\Helper;
use Corbado\Classes\ProjectConfiguration;
use CorbadoGenerated\Model\GenericRsp;
use CorbadoGenerated\Model\ProjectConfigSaveReq;
use GuzzleHttp\ClientInterface;
use JetBrains\PhpStorm\ArrayShape;

class ProjectConfig
{
    private ClientInterface $client;

    #[ArrayShape(['X-Corbado-ProjectID' => "string"])]
    private function generateHeaders(string $projectId): array
    {
        return ['X-Corbado-ProjectID' => $projectId];
    }

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function save(string $projectID, ProjectConfiguration $config, string $remoteAddress, string $userAgent, ?string $requestID = ''): GenericRsp
    {
        Assert::stringNotEmpty($projectID);

        Assert::notNull($config);
        Assert::stringNotEmpty($config->externalName);
        Assert::stringNotEmpty($config->emailFrom);
        Assert::stringNotEmpty($config->smsFrom);

        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new ProjectConfigSaveReq();
        $request->setExternalName($config->externalName);
        $request->setEmailFrom($config->emailFrom);
        $request->setSmsFrom($config->smsFrom);
        $request->setExternalApplicationProtocolVersion($config->externalApplicationProtocolVersion);
        $request->setWebhookUrl($config->webhookURL);
        $request->setWebhookUsername($config->webhookUsername);
        $request->setWebhookPassword($config->webhookPassword);
        $request->setWebhookCheckInvalidUsername($config->webhookCheckInvalidUsername);
        $request->setWebhookCheckValidUsername($config->webhookCheckValidUsername);
        $request->setWebhookCheckValidPassword($config->webhookCheckValidPassword);
        $request->setExternalApplicationUsername($config->externalApplicationUsername);
        $request->setExternalApplicationPassword($config->externalApplicationPassword);
        $request->setLegacyAuthMethodsUrl($config->legacyAuthMethodsUrl);
        $request->setPasswordVerifyUrl($config->passwordVerifyUrl);
        $request->setAuthSuccessRedirectUrl($config->authSuccessRedirectUrl);
        $request->setPasswordResetUrl($config->passwordResetUrl);
        $request->setAllowUserRegistration($config->allowUserRegistration);
        $request->setAllowIpStickiness($config->allowIPStickiness);
        $request->setPasskeyAppendInterval($config->passkeyAppendInterval);
        $request->setFallbackLanguage($config->fallbackLanguage);
        $request->setAutoDetectLanguage($config->autoDetectLanguage);
        $request->setIntegrationModeHosted($config->integrationModeHosted);
        $request->setIntegrationModeApi($config->integrationModeAPI);
        $request->setIntegrationModeWebComponent($config->integrationModeWebComponent);
        $request->setApplicationUrl($config->applicationUrl);
        $request->setUseCli($config->useCli);

        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $res = $this->client->request('POST', 'projectConfig', ['body' => Helper::jsonEncode($request->jsonSerialize()), 'headers' => $this->generateHeaders($projectID)]);
        $json = Helper::jsonDecode($res->getBody()->getContents());

        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }
        $response = new GenericRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);

        return $response;
    }

}
