<?php

namespace Corbado\Services;

use Corbado\Generated\Model\EmailCodeSendReq;
use Corbado\Generated\Model\EmailCodeSendRsp;
use Corbado\Generated\Model\EmailCodeValidateReq;
use Corbado\Generated\Model\EmailCodeValidateRsp;

interface EmailOTPInterface
{
    public function send(EmailCodeSendReq $req): EmailCodeSendRsp;
    public function validate(string $id, EmailCodeValidateReq $req): EmailCodeValidateRsp;
}
