<?php

namespace Corbado\Classes\Apis;

use Corbado\Generated\Model\EmailCodeSendReq;
use Corbado\Generated\Model\EmailCodeSendRsp;
use Corbado\Generated\Model\EmailCodeValidateReq;
use Corbado\Generated\Model\EmailCodeValidateRsp;

interface EmailCodesInterface
{
    public function send(EmailCodeSendReq $req): EmailCodeSendRsp;
    public function validate(string $id, EmailCodeValidateReq $req): EmailCodeValidateRsp;
}
