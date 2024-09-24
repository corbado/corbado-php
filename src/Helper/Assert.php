<?php

namespace Corbado\Helper;

use Corbado\Exceptions\AssertException;

class Assert
{
    /**
     * Checks if given data is not null
     *
     * @param mixed $data
     * @return void
     * @throws AssertException
     */
    public static function notNull(mixed $data): void
    {
        if ($data === null) {
            throw new AssertException('Assert failed: Given data is null');
        }
    }

    /**
     * Checks if string is not empty
     *
     * @param string $data
     * @return void
     * @throws AssertException
     */
    public static function stringNotEmpty(string $data): void
    {
        if ($data == '') {
            throw new AssertException('Assert failed: Given string is empty');
        }
    }

    /**
     * Checks if string is among the given possible values
     *
     * @param string $data
     * @param array<string> $possibleValues
     * @return void
     * @throws AssertException
     */
    public static function stringEquals(string $data, array $possibleValues): void
    {
        self::stringNotEmpty($data);

        if (in_array($data, $possibleValues, true)) {
            return;
        }

        throw new AssertException('Assert failed: Invalid value "' . $data . '" given, only the following are allowed: ' . implode(', ', $possibleValues));
    }

    /**
     * Checks if given keys exist in given data
     *
     * @param array<string, mixed> $data
     * @param array<string> $keys
     * @return void
     * @throws AssertException
     */
    public static function arrayKeysExist(array $data, array $keys): void
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $data)) {
                throw new AssertException('Assert failed: Given array has no key "' . $key . '"');
            }
        }
    }

    /**
     * Checks if given string exist in given string array
     *
     * @param array<string> $array
     * @param string $string
     * @return void
     * @throws AssertException
     */
    public static function arrayStringExist(array $array, string $string): void
    {
        if (!in_array($string, $array)) {
            throw new AssertException('Assert failed: Given array has no string "' . $string . '"');
        }
    }
}
