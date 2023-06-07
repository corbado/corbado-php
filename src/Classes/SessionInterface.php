<?php

namespace Corbado\Classes;

use stdClass;

interface SessionInterface
{
    public function getShortSessionValue() : string;
    public function validateShortSessionValue(string $value) : ?stdClass;
    public function getCurrentUser() : User;
}
