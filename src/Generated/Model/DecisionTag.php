<?php
/**
 * DecisionTag
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Corbado Backend API
 *
 * # Introduction This documentation gives an overview of all Corbado Backend API calls to implement passwordless authentication with Passkeys.
 *
 * The version of the OpenAPI document: 2.0.0
 * Contact: support@corbado.com
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.9.0-SNAPSHOT
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Corbado\Generated\Model;
use \Corbado\Generated\ObjectSerializer;

/**
 * DecisionTag Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class DecisionTag
{
    /**
     * Possible values of this enum
     */
    public const ENV_NO_PK_SUPPORT = 'env-no-pk-support';

    public const USER_NO_PKS = 'user-no-pks';

    public const USER_LOGIN_BLACKLISTED = 'user-login-blacklisted';

    public const USER_SECURITY_KEY = 'user-security-key';

    public const USER_POSITIVE_ENV_HISTORY = 'user-positive-env-history';

    public const USER_NEGATIVE_ENV_HISTORY = 'user-negative-env-history';

    public const ENV_BLACKLISTED = 'env-blacklisted';

    public const USER_PLATFORM_PK_HIGH_CONFIDENCE = 'user-platform-pk-high-confidence';

    public const USER_CROSS_PLATFORM_PK_HIGH_CONFIDENCE = 'user-cross-platform-pk-high-confidence';

    public const USER_ENV_NO_PKS = 'user-env-no-pks';

    public const DEFAULT_DENY = 'default-deny';

    public const PASSKEY_LIST_INITIATED_PROCESS = 'passkey-list-initiated-process';

    public const USER_APPEND_BLACKLISTED = 'user-append-blacklisted';

    public const PROCESS_PK_LOGIN_SK_COMPLETED = 'process-pk-login-sk-completed';

    public const PROCESS_PK_LOGIN_PLATFORM_COMPLETED = 'process-pk-login-platform-completed';

    public const PROCESS_PK_LOGIN_NOT_OFFERED = 'process-pk-login-not-offered';

    public const PROCESS_PK_LOGIN_INCOMPLETE = 'process-pk-login-incomplete';

    public const PROCESS_PK_LOGIN_CROSS_PLATFORM_COMPLETED = 'process-pk-login-cross-platform-completed';

    public const DEVICE_LOCAL_PLATFORM_PASSKEY_EXPERIMENT = 'device-local-platform-passkey-experiment';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::ENV_NO_PK_SUPPORT,
            self::USER_NO_PKS,
            self::USER_LOGIN_BLACKLISTED,
            self::USER_SECURITY_KEY,
            self::USER_POSITIVE_ENV_HISTORY,
            self::USER_NEGATIVE_ENV_HISTORY,
            self::ENV_BLACKLISTED,
            self::USER_PLATFORM_PK_HIGH_CONFIDENCE,
            self::USER_CROSS_PLATFORM_PK_HIGH_CONFIDENCE,
            self::USER_ENV_NO_PKS,
            self::DEFAULT_DENY,
            self::PASSKEY_LIST_INITIATED_PROCESS,
            self::USER_APPEND_BLACKLISTED,
            self::PROCESS_PK_LOGIN_SK_COMPLETED,
            self::PROCESS_PK_LOGIN_PLATFORM_COMPLETED,
            self::PROCESS_PK_LOGIN_NOT_OFFERED,
            self::PROCESS_PK_LOGIN_INCOMPLETE,
            self::PROCESS_PK_LOGIN_CROSS_PLATFORM_COMPLETED,
            self::DEVICE_LOCAL_PLATFORM_PASSKEY_EXPERIMENT
        ];
    }
}


