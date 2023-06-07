<?php

namespace Corbado\Classes;

use Corbado\Generated\Model\SessionTokenVerifyRsp;
use stdClass;

interface SessionInterface
{
    public function getShortSessionValue() : string;
    public function validateShortSessionValue(string $value) : ?stdClass;
    public function getCurrentUser() : User;
    public function verify(string $sessionToken, string $remoteAddress, string $userAgent, string $requestID = '') : SessionTokenVerifyRsp;
}
