<?php
/**
 * PasskeyAppendStartReq
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
 * PasskeyAppendStartReq Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class PasskeyAppendStartReq implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'passkeyAppendStartReq';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'user_id' => 'string',
        'process_id' => 'string',
        'username' => 'string',
        'client_information' => '\Corbado\Generated\Model\ClientInformation',
        'passkey_intel_flags' => '\Corbado\Generated\Model\PasskeyIntelFlags'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'user_id' => null,
        'process_id' => null,
        'username' => null,
        'client_information' => null,
        'passkey_intel_flags' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'user_id' => false,
        'process_id' => false,
        'username' => false,
        'client_information' => false,
        'passkey_intel_flags' => false
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
        'user_id' => 'userID',
        'process_id' => 'processID',
        'username' => 'username',
        'client_information' => 'clientInformation',
        'passkey_intel_flags' => 'passkeyIntelFlags'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'user_id' => 'setUserId',
        'process_id' => 'setProcessId',
        'username' => 'setUsername',
        'client_information' => 'setClientInformation',
        'passkey_intel_flags' => 'setPasskeyIntelFlags'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'user_id' => 'getUserId',
        'process_id' => 'getProcessId',
        'username' => 'getUsername',
        'client_information' => 'getClientInformation',
        'passkey_intel_flags' => 'getPasskeyIntelFlags'
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
        $this->setIfExists('user_id', $data ?? [], null);
        $this->setIfExists('process_id', $data ?? [], null);
        $this->setIfExists('username', $data ?? [], null);
        $this->setIfExists('client_information', $data ?? [], null);
        $this->setIfExists('passkey_intel_flags', $data ?? [], null);
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

        if ($this->container['user_id'] === null) {
            $invalidProperties[] = "'user_id' can't be null";
        }
        if ($this->container['process_id'] === null) {
            $invalidProperties[] = "'process_id' can't be null";
        }
        if ($this->container['username'] === null) {
            $invalidProperties[] = "'username' can't be null";
        }
        if ($this->container['client_information'] === null) {
            $invalidProperties[] = "'client_information' can't be null";
        }
        if ($this->container['passkey_intel_flags'] === null) {
            $invalidProperties[] = "'passkey_intel_flags' can't be null";
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
     * @param string $user_id ID of the user
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
     * Gets process_id
     *
     * @return string
     */
    public function getProcessId()
    {
        return $this->container['process_id'];
    }

    /**
     * Sets process_id
     *
     * @param string $process_id process_id
     *
     * @return self
     */
    public function setProcessId($process_id)
    {
        if (is_null($process_id)) {
            throw new \InvalidArgumentException('non-nullable process_id cannot be null');
        }
        $this->container['process_id'] = $process_id;

        return $this;
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->container['username'];
    }

    /**
     * Sets username
     *
     * @param string $username username
     *
     * @return self
     */
    public function setUsername($username)
    {
        if (is_null($username)) {
            throw new \InvalidArgumentException('non-nullable username cannot be null');
        }
        $this->container['username'] = $username;

        return $this;
    }

    /**
     * Gets client_information
     *
     * @return \Corbado\Generated\Model\ClientInformation
     */
    public function getClientInformation()
    {
        return $this->container['client_information'];
    }

    /**
     * Sets client_information
     *
     * @param \Corbado\Generated\Model\ClientInformation $client_information client_information
     *
     * @return self
     */
    public function setClientInformation($client_information)
    {
        if (is_null($client_information)) {
            throw new \InvalidArgumentException('non-nullable client_information cannot be null');
        }
        $this->container['client_information'] = $client_information;

        return $this;
    }

    /**
     * Gets passkey_intel_flags
     *
     * @return \Corbado\Generated\Model\PasskeyIntelFlags
     */
    public function getPasskeyIntelFlags()
    {
        return $this->container['passkey_intel_flags'];
    }

    /**
     * Sets passkey_intel_flags
     *
     * @param \Corbado\Generated\Model\PasskeyIntelFlags $passkey_intel_flags passkey_intel_flags
     *
     * @return self
     */
    public function setPasskeyIntelFlags($passkey_intel_flags)
    {
        if (is_null($passkey_intel_flags)) {
            throw new \InvalidArgumentException('non-nullable passkey_intel_flags cannot be null');
        }
        $this->container['passkey_intel_flags'] = $passkey_intel_flags;

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


