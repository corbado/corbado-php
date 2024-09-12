<?php

namespace integration;

use Corbado\Config;
use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ConfigException;
use Corbado\Generated\Model\UserCreateReq;
use Corbado\Generated\Model\UserStatus;
use Corbado\SDK;
use Exception;

class Utils
{
    /**
     * @throws AssertException
     * @throws ConfigException
     * @throws Exception
     */
    public static function SDK(): SDK
    {
        $config = new Config(self::getEnv('CORBADO_PROJECT_ID'), self::getEnv('CORBADO_API_SECRET'));
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

    public static function generateString(int $length): string
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
        return 'integration-test+' . self::generateString(10) . '@corbado.com';
    }

    public static function createRandomTestPhoneNumber(): string
    {
        return '+491509' . self::generateNumber(7);
    }

    /**
     * @throws AssertException
     * @throws ConfigException
     */
    public static function createUser(): string
    {
        $req = new UserCreateReq();
        $req->setFullName(self::createRandomTestName());
        // @phpstan-ignore-next-line
        $req->setStatus(UserStatus::ACTIVE);

        $user = self::SDK()->users()->create($req);

        return $user->getUserId();
    }
}
