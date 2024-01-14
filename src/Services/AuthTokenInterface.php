<?php

namespace Corbado\Services;

use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\Generated\Model\AuthTokenValidateRsp;

interface AuthTokenInterface
{
    public function validate(AuthTokenValidateReq $req): AuthTokenValidateRsp;
}
