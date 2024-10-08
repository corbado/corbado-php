<?php
/**
 * SocialProviderType
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
 * SocialProviderType Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class SocialProviderType
{
    /**
     * Possible values of this enum
     */
    public const GOOGLE = 'google';

    public const MICROSOFT = 'microsoft';

    public const GITHUB = 'github';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::GOOGLE,
            self::MICROSOFT,
            self::GITHUB
        ];
    }
}


