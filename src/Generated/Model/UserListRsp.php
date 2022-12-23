<?php
/**
 * UserListRsp
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Corbado API
 *
 * # Introduction The Corbado API is documented in **OpenAPI format** and provides an overview of all Corbado API calls to implement passwordless authentication with Passkeys (Biometrics).  # Authentication To authenticate your API requests HTTP Basic Auth is used.  You need to set the projectID as username and the API secret as password. The authorization header look as follows:  `Basic <<projectID>:<API secret>>`  The **authorization header** needs to be **Base64 encrypted** to be working. If the authorization header is missing or incorrect, the API will respond with 401.  ## basicAuth **Security Scheme Type:** HTTP  **HTTP Authorization Scheme:** `basic`   ## projectID **Security Scheme Type:** API Key  **Header parameter name:** `x-Corbado-ProjectID`  # Security and privacy Corbado services are designed, developed, monitored, and updated with security at our core to protect you and your customers’ data and privacy.  ## Security  ### Infrastructure security Corbado leverages highly available and secure cloud infrastructure to ensure that our services are always available and securely delivered. Corbado's services are operated in uvensyse GmbH's data centers in Germany and comply with ISO standard 27001. All data centers have redundant power and internet connections to avoid failure. The main location of the servers used is in Linden and offers 24/7 support. We do not use any AWS, GCP or Azure services.  Each server is monitored 24/7 and in the event of problems, automated information is sent via SMS and e-mail. The monitoring is done by the external service provider Serverguard24 GmbH.   All Corbado hardware and networking is routinely updated and audited to ensure systems are secure and that least privileged access is followed. Additionally we implement robust logging and audit protocols that allow us high visibility into system use.  ### Responsible disclosure program Here at Corbado, we take the security of our user’s data and of our services seriously. As such, we encourage responsible security research on Corbado services and products. If you believe you’ve discovered a potential vulnerability, please let us know by emailing us at [security@corbado.com](mailto:security@corbado.com). We will acknowledge your email within 2 business days. As public disclosures of a security vulnerability could put the entire Corbado community at risk, we ask that you keep such potential vulnerabilities confidential until we are able to address them. We aim to resolve critical issues within 30 days of disclosure. Please make a good faith effort to avoid violating privacy, destroying data, or interrupting or degrading the Corbado service. Please only interact with accounts you own or for which you have explicit permission from the account holder. While researching, please refrain from:  - Distributed Denial of Service (DDoS) - Spamming - Social engineering or phishing of Corbado employees or contractors - Any attacks against Corbado's physical property or data centers  Thank you for helping to keep Corbado and our users safe!  ### Rate limiting At Corbado, we apply rate limit policies on our APIs in order to protect your application and user management infrastructure, so your users will have a frictionless non-interrupted experience.  Corbado responds with HTTP status code 429 (too many requests) when the rate limits exceed. Your code logic should be able to handle such cases by checking the status code on the response and recovering from such cases. If a retry is needed, it is best to allow for a back-off to avoid going into an infinite retry loop.  The current rate limit for all our API endpoints is **max. 100 requests per 10 seconds**.  ## Privacy Corbado is committed to protecting the personal data of our customers and their customers. Corbado has in place appropriate data security measures that meet industry standards. We regularly review and make enhancements to our processes, products, documentation, and contracts to help support ours and our customers’ compliance for the processing of personal data.  We try to minimize the usage and processing of personally identifiable information. Therefore, all our services are constructed to avoid unnecessary data consumption.  To make our services work, we only require the following data: - any kind of identifier (e.g. UUID, phone number, email address) - IP address (only temporarily for rate limiting aspects) - User agent (for device management)
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: support@corbado.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
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
 * UserListRsp Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class UserListRsp implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'userListRsp';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'http_status_code' => 'int',
        'message' => 'string',
        'request_data' => '\Corbado\Generated\Model\RequestData',
        'runtime' => 'float',
        'data' => '\Corbado\Generated\Model\UserListRspAllOfData'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'http_status_code' => 'int32',
        'message' => null,
        'request_data' => null,
        'runtime' => 'float',
        'data' => null
    ];

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
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'http_status_code' => 'httpStatusCode',
        'message' => 'message',
        'request_data' => 'requestData',
        'runtime' => 'runtime',
        'data' => 'data'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'http_status_code' => 'setHttpStatusCode',
        'message' => 'setMessage',
        'request_data' => 'setRequestData',
        'runtime' => 'setRuntime',
        'data' => 'setData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'http_status_code' => 'getHttpStatusCode',
        'message' => 'getMessage',
        'request_data' => 'getRequestData',
        'runtime' => 'getRuntime',
        'data' => 'getData'
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
        $this->container['http_status_code'] = $data['http_status_code'] ?? null;
        $this->container['message'] = $data['message'] ?? null;
        $this->container['request_data'] = $data['request_data'] ?? null;
        $this->container['runtime'] = $data['runtime'] ?? null;
        $this->container['data'] = $data['data'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['http_status_code'] === null) {
            $invalidProperties[] = "'http_status_code' can't be null";
        }
        if (($this->container['http_status_code'] > 599)) {
            $invalidProperties[] = "invalid value for 'http_status_code', must be smaller than or equal to 599.";
        }

        if (($this->container['http_status_code'] < 200)) {
            $invalidProperties[] = "invalid value for 'http_status_code', must be bigger than or equal to 200.";
        }

        if ($this->container['message'] === null) {
            $invalidProperties[] = "'message' can't be null";
        }
        if ($this->container['request_data'] === null) {
            $invalidProperties[] = "'request_data' can't be null";
        }
        if ($this->container['runtime'] === null) {
            $invalidProperties[] = "'runtime' can't be null";
        }
        if ($this->container['data'] === null) {
            $invalidProperties[] = "'data' can't be null";
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
     * Gets http_status_code
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->container['http_status_code'];
    }

    /**
     * Sets http_status_code
     *
     * @param int $http_status_code HTTP status code of operation
     *
     * @return self
     */
    public function setHttpStatusCode($http_status_code)
    {

        if (($http_status_code > 599)) {
            throw new \InvalidArgumentException('invalid value for $http_status_code when calling UserListRsp., must be smaller than or equal to 599.');
        }
        if (($http_status_code < 200)) {
            throw new \InvalidArgumentException('invalid value for $http_status_code when calling UserListRsp., must be bigger than or equal to 200.');
        }

        $this->container['http_status_code'] = $http_status_code;

        return $this;
    }

    /**
     * Gets message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     *
     * @param string $message message
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets request_data
     *
     * @return \Corbado\Generated\Model\RequestData
     */
    public function getRequestData()
    {
        return $this->container['request_data'];
    }

    /**
     * Sets request_data
     *
     * @param \Corbado\Generated\Model\RequestData $request_data request_data
     *
     * @return self
     */
    public function setRequestData($request_data)
    {
        $this->container['request_data'] = $request_data;

        return $this;
    }

    /**
     * Gets runtime
     *
     * @return float
     */
    public function getRuntime()
    {
        return $this->container['runtime'];
    }

    /**
     * Sets runtime
     *
     * @param float $runtime Runtime in seconds for this request
     *
     * @return self
     */
    public function setRuntime($runtime)
    {
        $this->container['runtime'] = $runtime;

        return $this;
    }

    /**
     * Gets data
     *
     * @return \Corbado\Generated\Model\UserListRspAllOfData
     */
    public function getData()
    {
        return $this->container['data'];
    }

    /**
     * Sets data
     *
     * @param \Corbado\Generated\Model\UserListRspAllOfData $data data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->container['data'] = $data;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
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
    public function offsetSet($offset, $value)
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
    public function offsetUnset($offset)
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


