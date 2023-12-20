<?php

namespace Corbado\Services;

use Corbado\Classes\Exceptions\Http;
use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\ValidationApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\ValidateEmailReq;
use Corbado\Generated\Model\ValidateEmailRsp;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use Corbado\Generated\Model\ValidatePhoneNumberRsp;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class Validations implements ValidationsInterface
{
    private ValidationApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(ValidationApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
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
            $rsp = $this->client->validateEmail($req);
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
            $rsp = $this->client->validatePhoneNumber($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
