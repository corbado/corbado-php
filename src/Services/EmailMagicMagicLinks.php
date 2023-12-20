<?php

namespace Corbado\Services;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\EmailMagicLinksApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\EmailLinkSendReq;
use Corbado\Generated\Model\EmailLinkSendRsp;
use Corbado\Generated\Model\EmailLinksValidateReq;
use Corbado\Generated\Model\EmailLinkValidateRsp;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

class EmailMagicMagicLinks implements EmailMagicLinksInterface
{
    private EmailMagicLinksApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(EmailMagicLinksApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @throws AssertException
     * @throws ServerException
     * @throws StandardException
     */
    public function send(EmailLinkSendReq $req): EmailLinkSendRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->client->emailLinkSend($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }

    /**
     * @throws AssertException
     * @throws ServerException
     * @throws StandardException
     */
    public function validate(string $id, EmailLinksValidateReq $req): EmailLinkValidateRsp
    {
        Assert::stringNotEmpty($id);
        Assert::notNull($req);

        try {
            $rsp = $this->client->emailLinkValidate($id, $req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
