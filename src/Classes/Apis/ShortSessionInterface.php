<?php

namespace Corbado\Classes\Apis;

use stdClass;

interface ShortSessionInterface
{
    public function validate(string $jwt) : ?stdClass;
}
