<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Corbado\Classes\Helper;
use CorbadoGenerated\Model\ClientInfo;
use CorbadoGenerated\Model\PhoneNumberValidationResult;
use CorbadoGenerated\Model\SessionTokenVerifyReq;
use CorbadoGenerated\Model\SessionTokenVerifyRsp;
use CorbadoGenerated\Model\SessionTokenVerifyRspAllOfData;
use CorbadoGenerated\Model\ValidatePhoneNumberReq;
use CorbadoGenerated\Model\WebAuthnAuthenticateFinishRsp;
use CorbadoGenerated\Model\WebAuthnAuthenticateStartReq;
use CorbadoGenerated\Model\WebAuthnAuthenticateStartRsp;
use CorbadoGenerated\Model\WebAuthnAuthenticateSuccessRsp;
use CorbadoGenerated\Model\WebAuthnCredentialReq;
use CorbadoGenerated\Model\WebAuthnCredentialRsp;
use CorbadoGenerated\Model\WebAuthnFinishReq;
use CorbadoGenerated\Model\WebAuthnRegisterFinishRsp;
use CorbadoGenerated\Model\WebAuthnRegisterStartReq;
use CorbadoGenerated\Model\WebAuthnRegisterStartRsp;
use GuzzleHttp\ClientInterface;
use JetBrains\PhpStorm\ArrayShape;

class Widget
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

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

       $res = $this->client->request('POST', '/v1/sessions/verify', ['body' => Helper::jsonEncode($request->jsonSerialize())]);
       $json = Helper::jsonDecode($res->getBody()->getContents());

       if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
           Helper::throwException($json);
       }

       $data = new SessionTokenVerifyRspAllOfData();
       $data->setUserData($json['data']['userData']);

       $response = new SessionTokenVerifyRsp();
       $response->setData($data);

       return $response;
   }

}
