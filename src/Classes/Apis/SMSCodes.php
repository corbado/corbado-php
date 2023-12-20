<?php

namespace Corbado\Classes\Apis;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\SMSOTPApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Generated\Model\SmsCodeSendReq;
use Corbado\Generated\Model\SmsCodeSendRsp;
use Corbado\Generated\Model\SmsCodeValidateReq;
use Corbado\Generated\Model\SmsCodeValidateRsp;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class SMSCodes implements SMSCodesInterface
{
    private SMSOTPApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(SMSOTPApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @throws AssertException
     * @throws ServerException
     * @throws StandardException
     */
    public function send(SmsCodeSendReq $req): SmsCodeSendRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->client->smsCodeSend($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }

    /**
     * @throws StandardException
     * @throws AssertException
     * @throws ServerException
     */
    public function validate(string $id, SmsCodeValidateReq $req): SmsCodeValidateRsp
    {
        Assert::stringNotEmpty($id);
        Assert::notNull($req);

        try {
            $rsp = $this->client->smsCodeValidate($id, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
