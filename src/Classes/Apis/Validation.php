<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Classes\Helper;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\EmailValidationResult;
use Corbado\Generated\Model\PhoneNumberValidationResult;
use Corbado\Generated\Model\ValidateEmailReq;
use Corbado\Generated\Model\ValidateEmailRsp;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use Corbado\Generated\Model\ValidatePhoneNumberRsp;
use Corbado\Generated\Model\ValidationEmail;
use Corbado\Generated\Model\ValidationPhoneNumber;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class Validation
{
    private ClientInterface $client;

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
    public function validateEmail(string $email, string $remoteAddress, string $userAgent, bool $smtpCheck = false, bool $suggestDomain = false, ?string $requestID = ''): ValidateEmailRsp
    {
        Assert::stringNotEmpty($email);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new ValidateEmailReq();
        $request->setEmail($email);
        $request->setSmtpCheck($smtpCheck);
        $request->setSuggestDomain($suggestDomain);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'PUT',
                'validate/email',
                ['body' => Helper::jsonEncode($request->jsonSerialize())]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $data = new EmailValidationResult();
        $data->setIsValid($json['data']['isValid']);
        $data->setValidationCode($json['data']['validationCode']);

        if (array_key_exists('email', $json['data'])) {
            $email = new ValidationEmail();
            $email->setUsername($json['data']['email']['username']);
            $email->setDomain($json['data']['email']['domain']);
            $email->setReachable($json['data']['email']['reachable']);
            $email->setDisposable($json['data']['email']['disposable']);
            $email->setFree($json['data']['email']['free']);
            $email->setHasMxRecords($json['data']['email']['hasMxRecords']);

            $data->setEmail($email);
        }

        if (array_key_exists('suggestion', $json['data'])) {
            $data->setSuggestion($json['data']['suggestion']);
        }

        $response = new ValidateEmailRsp();
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
     * @throws Standard
     */
    public function validatePhoneNumber(string $phoneNumber, string $remoteAddress, string $userAgent, ?string $regionCode = '', ?string $requestID = ''): ValidatePhoneNumberRsp
    {
        Assert::stringNotEmpty($phoneNumber);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new ValidatePhoneNumberReq();
        $request->setPhoneNumber($phoneNumber);
        $request->setRegionCode($regionCode);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'PUT',
                'validate/phoneNumber',
                ['body' => Helper::jsonEncode($request->jsonSerialize())]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $data = new PhoneNumberValidationResult();
        $data->setIsValid($json['data']['isValid']);
        $data->setValidationCode($json['data']['validationCode']);

        if (array_key_exists('phoneNumber', $json['data'])) {
            $phoneNumber = new ValidationPhoneNumber();
            $phoneNumber->setNationalNumber($json['data']['phoneNumber']['nationalNumber']);
            $phoneNumber->setCountryCode($json['data']['phoneNumber']['countryCode']);
            $phoneNumber->setRegionCode($json['data']['phoneNumber']['regionCode']);
            $phoneNumber->setNationalFormatted($json['data']['phoneNumber']['nationalFormatted']);
            $phoneNumber->setInternationalFormatted($json['data']['phoneNumber']['internationalFormatted']);

            $data->setPhoneNumber($phoneNumber);
        }

        $response = new ValidatePhoneNumberRsp();
        $response->setHttpStatusCode($json['httpStatusCode']);
        $response->setMessage($json['message']);
        $response->setRequestData(Helper::hydrateRequestData($json['requestData']));
        $response->setRuntime($json['runtime']);
        $response->setData($data);

        return $response;
    }
}
