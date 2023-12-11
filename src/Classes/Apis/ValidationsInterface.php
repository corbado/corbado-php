<?php

namespace Corbado\Classes\Apis;

use Corbado\Generated\Model\ValidateEmailReq;
use Corbado\Generated\Model\ValidateEmailRsp;
use Corbado\Generated\Model\ValidatePhoneNumberReq;
use Corbado\Generated\Model\ValidatePhoneNumberRsp;

interface ValidationsInterface
{
    public function validateEmail(ValidateEmailReq $req): ValidateEmailRsp;
    public function validatePhoneNumber(ValidatePhoneNumberReq $req): ValidatePhoneNumberRsp;
}
