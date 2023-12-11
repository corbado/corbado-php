<?php

namespace Corbado\Classes\Apis;

use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\Generated\Model\AuthTokenValidateRsp;

interface AuthTokensInterface
{
    public function validate(AuthTokenValidateReq $req): AuthTokenValidateRsp;
}
