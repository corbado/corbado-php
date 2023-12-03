<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Classes\Exceptions\StandardException;
use Corbado\Classes\Helper;
use Corbado\Generated\Api\ValidationApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\EmailValidationResult;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\PhoneNumberValidationResult;
use Corbado\Generated\Model\ValidateEmailReq;
use Corbado\Generated\Model\ValidateEmailRsp;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use Corbado\Generated\Model\ValidatePhoneNumberRsp;
use Corbado\Generated\Model\ValidationEmail;
use Corbado\Generated\Model\ValidationPhoneNumber;
use Corbado\SDK;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class Validations implements ValidationsInterface
{
    private ValidationApi $api;

    /**
     * @throws AssertException
     */
    public function __construct(ValidationApi $api)
    {
        Assert::notNull($api);
        $this->api = $api;
    }

    /**
     * Validates email address
     *
     * @throws AssertException
     * @throws ServerException
     * @throws StandardException
     */
    public function validateEmail(ValidateEmailReq $req): ValidateEmailRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->api->validateEmail($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }

    /**
     * Validates phone number
     *
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function validatePhoneNumber(ValidatePhoneNumberReq $req): ValidatePhoneNumberRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->api->validatePhoneNumber($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
