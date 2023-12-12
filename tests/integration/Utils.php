<?php

namespace integration;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Configuration;
use Corbado\SDK;
use Exception;

class Utils
{
    /**
     * @throws AssertException
     * @throws ConfigurationException
     * @throws Exception
     */
    public static function SDK(): SDK
    {
        $config = new Configuration(self::getEnv('CORBADO_PROJECT_ID'), self::getEnv('CORBADO_API_SECRET'));
        $config->setBackendAPI(self::getEnv('CORBADO_BACKEND_API'));

        return new SDK($config);
    }

    /**
     * @throws Exception
     */
    private static function getEnv(string $key): string
    {
        $value = getenv($key);
        if ($value === false) {
            throw new Exception('Environment variable ' . $key . ' not found');
        }

        return $value;
    }
}
