<?php

namespace Corbado\Services;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\EmailOTPApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\EmailCodeSendReq;
use Corbado\Generated\Model\EmailCodeSendRsp;
use Corbado\Generated\Model\EmailCodeValidateReq;
use Corbado\Generated\Model\EmailCodeValidateRsp;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class EmailCodes implements EmailCodesInterface
{
    private EmailOTPApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(EmailOTPApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @throws AssertException
     * @throws ServerException
     * @throws StandardException
     */
    public function send(EmailCodeSendReq $req): EmailCodeSendRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->client->emailCodeSend($req);
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
    public function validate(string $id, EmailCodeValidateReq $req): EmailCodeValidateRsp
    {
        Assert::stringNotEmpty($id);
        Assert::notNull($req);

        try {
            $rsp = $this->client->emailCodeValidate($id, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
