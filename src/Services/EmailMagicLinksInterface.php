<?php

namespace Corbado\Services;

use Corbado\Generated\Model\EmailLinkSendReq;
use Corbado\Generated\Model\EmailLinkSendRsp;
use Corbado\Generated\Model\EmailLinksValidateReq;
use Corbado\Generated\Model\EmailLinkValidateRsp;

interface EmailMagicLinksInterface
{
    public function send(EmailLinkSendReq $req): EmailLinkSendRsp;
    public function validate(string $id, EmailLinksValidateReq $req): EmailLinkValidateRsp;
}
