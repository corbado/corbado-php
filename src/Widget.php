<?php

namespace Corbado;

use Corbado\Classes\Assert;
use Corbado\Classes\Helper;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\PhoneNumberValidationResult;
use Corbado\Generated\Model\SessionTokenVerifyReq;
use Corbado\Generated\Model\SessionTokenVerifyRsp;
use Corbado\Generated\Model\SessionTokenVerifyRspAllOfData;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp;
use Corbado\Generated\Model\WebAuthnAuthenticateStartReq;
use Corbado\Generated\Model\WebAuthnAuthenticateStartRsp;
use Corbado\Generated\Model\WebAuthnAuthenticateSuccessRsp;
use Corbado\Generated\Model\WebAuthnCredentialReq;
use Corbado\Generated\Model\WebAuthnCredentialRsp;
use Corbado\Generated\Model\WebAuthnFinishReq;
use Corbado\Generated\Model\WebAuthnRegisterFinishRsp;
use Corbado\Generated\Model\WebAuthnRegisterStartReq;
use Corbado\Generated\Model\WebAuthnRegisterStartRsp;
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
       $data->setUserId($json['data']['userID']);
       $data->setUserData($json['data']['userData']);

       $response = new SessionTokenVerifyRsp();
       $response->setData($data);

       return $response;
   }

}
