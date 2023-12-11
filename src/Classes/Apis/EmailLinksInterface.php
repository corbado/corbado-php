<?php

namespace Corbado\Classes\Apis;

use Corbado\Generated\Model\EmailLinkSendReq;
use Corbado\Generated\Model\EmailLinkSendRsp;
use Corbado\Generated\Model\EmailLinksValidateReq;
use Corbado\Generated\Model\EmailLinkValidateRsp;

interface EmailLinksInterface
{
    public function send(EmailLinkSendReq $req): EmailLinkSendRsp;
    public function validate(string $id, EmailLinksValidateReq $req): EmailLinkValidateRsp;
}
