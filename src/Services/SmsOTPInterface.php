<?php

namespace Corbado\Services;

use Corbado\Generated\Model\SmsCodeSendReq;
use Corbado\Generated\Model\SmsCodeSendRsp;
use Corbado\Generated\Model\SmsCodeValidateReq;
use Corbado\Generated\Model\SmsCodeValidateRsp;

interface SmsOTPInterface
{
    public function send(SmsCodeSendReq $req): SmsCodeSendRsp;
    public function validate(string $id, SmsCodeValidateReq $req): SmsCodeValidateRsp;
}
