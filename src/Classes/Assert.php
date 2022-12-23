<?php

namespace Corbado\Classes;

class Assert {
    public static function stringNotEmpty(string $data) {
        if ($data == '') {
            throw new \Corbado\Exceptions\Assert('Assert failed: Given string is empty');
        }
    }

    public static function arrayKeysExist(array $data, array $keys) {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {
                throw new \Corbado\Exceptions\Assert('Assert failed: Given array has no key "' . $key . '"');
            }
        }
    }
}