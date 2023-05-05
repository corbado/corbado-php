<?php

namespace Corbado\Classes;

class Assert {

    /**
     * Checks if string is not empty
     *
     * @param string $data
     * @return void
     * @throws \Corbado\Webhook\Exceptions\Assert
     */
    public static function stringNotEmpty(string $data) {
        if ($data == '') {
            throw new \Corbado\Webhook\Exceptions\Assert('Assert failed: Given string is empty');
        }
    }

    /**
     * Checks if string is among the given possible values
     *
     * @param string $data
     * @param array<string> $possibleValues
     * @return void
     * @throws \Corbado\Webhook\Exceptions\Assert
     */
    public static function stringEquals(string $data, array $possibleValues) {
        self::stringNotEmpty($data);

        foreach ($possibleValues as $k => $v) {
            if ($data === $v) {
                return;
            }
        }

        throw new \Corbado\Webhook\Exceptions\Assert('Assert failed: Invalid value "' . $data . '" given, only the following are allowed: ' . implode(', ', $possibleValues));
    }

    /**
     * Checks if given keys exist in given data
     *
     * @param array<string, mixed> $data
     * @param array<string> $keys
     * @return void
     * @throws \Corbado\Webhook\Exceptions\Assert
     */
    public static function arrayKeysExist(array $data, array $keys) {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {
                throw new \Corbado\Webhook\Exceptions\Assert('Assert failed: Given array has no key "' . $key . '"');
            }
        }
    }
}
