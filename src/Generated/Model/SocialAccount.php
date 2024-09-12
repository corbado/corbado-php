<?php
/**
 * SocialAccount
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

use \ArrayAccess;
use \Corbado\Generated\ObjectSerializer;

/**
 * SocialAccount Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SocialAccount implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'socialAccount';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'social_account_id' => 'string',
        'provider_type' => 'string',
        'identifier_value' => 'string',
        'user_id' => 'string',
        'foreign_id' => 'string',
        'avatar_url' => 'string',
        'full_name' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'social_account_id' => null,
        'provider_type' => null,
        'identifier_value' => null,
        'user_id' => null,
        'foreign_id' => null,
        'avatar_url' => null,
        'full_name' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'social_account_id' => false,
        'provider_type' => false,
        'identifier_value' => false,
        'user_id' => false,
        'foreign_id' => false,
        'avatar_url' => false,
        'full_name' => false
    ];

    /**
      * If a nullable field gets set to null, insert it here
      *
      * @var boolean[]
      */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'social_account_id' => 'socialAccountID',
        'provider_type' => 'providerType',
        'identifier_value' => 'identifierValue',
        'user_id' => 'userID',
        'foreign_id' => 'foreignID',
        'avatar_url' => 'avatarURL',
        'full_name' => 'fullName'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'social_account_id' => 'setSocialAccountId',
        'provider_type' => 'setProviderType',
        'identifier_value' => 'setIdentifierValue',
        'user_id' => 'setUserId',
        'foreign_id' => 'setForeignId',
        'avatar_url' => 'setAvatarUrl',
        'full_name' => 'setFullName'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'social_account_id' => 'getSocialAccountId',
        'provider_type' => 'getProviderType',
        'identifier_value' => 'getIdentifierValue',
        'user_id' => 'getUserId',
        'foreign_id' => 'getForeignId',
        'avatar_url' => 'getAvatarUrl',
        'full_name' => 'getFullName'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->setIfExists('social_account_id', $data ?? [], null);
        $this->setIfExists('provider_type', $data ?? [], null);
        $this->setIfExists('identifier_value', $data ?? [], null);
        $this->setIfExists('user_id', $data ?? [], null);
        $this->setIfExists('foreign_id', $data ?? [], null);
        $this->setIfExists('avatar_url', $data ?? [], null);
        $this->setIfExists('full_name', $data ?? [], null);
    }

    /**
    * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
    * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
    * $this->openAPINullablesSetToNull array
    *
    * @param string $variableName
    * @param array  $fields
    * @param mixed  $defaultValue
    */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['social_account_id'] === null) {
            $invalidProperties[] = "'social_account_id' can't be null";
        }
        if ($this->container['provider_type'] === null) {
            $invalidProperties[] = "'provider_type' can't be null";
        }
        if ($this->container['identifier_value'] === null) {
            $invalidProperties[] = "'identifier_value' can't be null";
        }
        if ($this->container['user_id'] === null) {
            $invalidProperties[] = "'user_id' can't be null";
        }
        if ($this->container['foreign_id'] === null) {
            $invalidProperties[] = "'foreign_id' can't be null";
        }
        if ($this->container['avatar_url'] === null) {
            $invalidProperties[] = "'avatar_url' can't be null";
        }
        if ($this->container['full_name'] === null) {
            $invalidProperties[] = "'full_name' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets social_account_id
     *
     * @return string
     */
    public function getSocialAccountId()
    {
        return $this->container['social_account_id'];
    }

    /**
     * Sets social_account_id
     *
     * @param string $social_account_id social_account_id
     *
     * @return self
     */
    public function setSocialAccountId($social_account_id)
    {
        if (is_null($social_account_id)) {
            throw new \InvalidArgumentException('non-nullable social_account_id cannot be null');
        }
        $this->container['social_account_id'] = $social_account_id;

        return $this;
    }

    /**
     * Gets provider_type
     *
     * @return string
     */
    public function getProviderType()
    {
        return $this->container['provider_type'];
    }

    /**
     * Sets provider_type
     *
     * @param string $provider_type provider_type
     *
     * @return self
     */
    public function setProviderType($provider_type)
    {
        if (is_null($provider_type)) {
            throw new \InvalidArgumentException('non-nullable provider_type cannot be null');
        }
        $this->container['provider_type'] = $provider_type;

        return $this;
    }

    /**
     * Gets identifier_value
     *
     * @return string
     */
    public function getIdentifierValue()
    {
        return $this->container['identifier_value'];
    }

    /**
     * Sets identifier_value
     *
     * @param string $identifier_value identifier_value
     *
     * @return self
     */
    public function setIdentifierValue($identifier_value)
    {
        if (is_null($identifier_value)) {
            throw new \InvalidArgumentException('non-nullable identifier_value cannot be null');
        }
        $this->container['identifier_value'] = $identifier_value;

        return $this;
    }

    /**
     * Gets user_id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->container['user_id'];
    }

    /**
     * Sets user_id
     *
     * @param string $user_id user_id
     *
     * @return self
     */
    public function setUserId($user_id)
    {
        if (is_null($user_id)) {
            throw new \InvalidArgumentException('non-nullable user_id cannot be null');
        }
        $this->container['user_id'] = $user_id;

        return $this;
    }

    /**
     * Gets foreign_id
     *
     * @return string
     */
    public function getForeignId()
    {
        return $this->container['foreign_id'];
    }

    /**
     * Sets foreign_id
     *
     * @param string $foreign_id foreign_id
     *
     * @return self
     */
    public function setForeignId($foreign_id)
    {
        if (is_null($foreign_id)) {
            throw new \InvalidArgumentException('non-nullable foreign_id cannot be null');
        }
        $this->container['foreign_id'] = $foreign_id;

        return $this;
    }

    /**
     * Gets avatar_url
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->container['avatar_url'];
    }

    /**
     * Sets avatar_url
     *
     * @param string $avatar_url avatar_url
     *
     * @return self
     */
    public function setAvatarUrl($avatar_url)
    {
        if (is_null($avatar_url)) {
            throw new \InvalidArgumentException('non-nullable avatar_url cannot be null');
        }
        $this->container['avatar_url'] = $avatar_url;

        return $this;
    }

    /**
     * Gets full_name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->container['full_name'];
    }

    /**
     * Sets full_name
     *
     * @param string $full_name full_name
     *
     * @return self
     */
    public function setFullName($full_name)
    {
        if (is_null($full_name)) {
            throw new \InvalidArgumentException('non-nullable full_name cannot be null');
        }
        $this->container['full_name'] = $full_name;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


