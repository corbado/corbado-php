<?php

namespace Corbado\Classes\Apis;

use stdClass;

interface ShortSessionInterface
{
    public function getValue() : string;
    public function validate(string $jwt) : ?stdClass;
}
