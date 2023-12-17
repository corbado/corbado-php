<?php

namespace integration;

use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ConfigurationException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Configuration;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\UserCreateReq;
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

    private static function generateString(int $length): string
    {
        // Removed I, 1, 0 and O because of risk of confusion
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnopwrstuvwxyz23456789';
        $charactersLength = strlen($characters);

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, $charactersLength - 1)];
        }

        return $string;
    }

    private static function generateNumber(int $length): string
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, $charactersLength - 1)];
        }

        return $string;
    }

    public static function createRandomTestName(): string
    {
        return self::generateString(10);
    }

    public static function createRandomTestEmail(): string
    {
        return self::generateString(10) . '@test.de';
    }

    public static function createRandomTestPhoneNumber(): string
    {
        return '+49' . self::generateNumber(13);
    }

    /**
     * @throws AssertException
     * @throws ConfigurationException
     */
    public static function createUser(): string
    {
        $req = new UserCreateReq();
        $req->setName(self::createRandomTestName());
        $req->setEmail(self::createRandomTestEmail());

        $rsp = self::SDK()->users()->create($req);

        return $rsp->getData()->getUserId();
    }
}
