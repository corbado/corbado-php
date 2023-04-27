<?php

namespace Corbado\Classes;

class Assert {
    public static function stringNotEmpty(string $data) : void {
        if ($data == '') {
            throw new \Corbado\Exceptions\Assert('Assert failed: Given string is empty');
        }
    }

    /**
     * @param array<string,mixed> $data
     * @param array<string> $keys
     * @throws \Corbado\Exceptions\Assert
     */
    public static function arrayKeysExist(array $data, array $keys) : void {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {
                throw new \Corbado\Exceptions\Assert('Assert failed: Given array has no key "' . $key . '"');
            }
        }
    }
}