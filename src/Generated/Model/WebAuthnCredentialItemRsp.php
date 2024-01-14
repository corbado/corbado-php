<?php
/**
 * WebAuthnCredentialItemRsp
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
 * # Introduction This documentation gives an overview of all Corbado Backend API calls to implement passwordless authentication with Passkeys.  The Corbado Backend API is organized around REST principles. It uses resource-oriented URLs with verbs (HTTP methods) and HTTP status codes. Requests need to be valid JSON payloads. We always return JSON.  The Corbado Backend API specification is written in **OpenAPI Version 3.0.3**. You can download it via the download button at the top and use it to generate clients in languages we do not provide officially for example.  # Authentication To authenticate your API requests HTTP Basic Auth is used.  You need to set the projectID as username and the API secret as password. The authorization header looks as follows:  `Basic <<projectID>:<API secret>>`  The **authorization header** needs to be **Base64 encoded** to be working. If the authorization header is missing or incorrect, the API will respond with status code 401.  # Error types As mentioned above we make use of HTTP status codes. **4xx** errors indicate so called client errors, meaning the error occurred on client side and you need to fix it. **5xx** errors indicate server errors, which means the error occurred on server side and outside your control.  Besides HTTP status codes Corbado uses what we call error types which gives more details in error cases and help you to debug your request.  ## internal_error The error type **internal_error** is used when some internal error occurred at Corbado. You can retry your request but usually there is nothing you can do about it. All internal errors get logged and will triggert an alert to our operations team which takes care of the situation as soon as possible.  ## not_found The error type **not_found** is used when you try to get a resource which cannot be found. Most common case is that you provided a wrong ID.  ## method_not_allowed The error type **method_not_allowed** is used when you use a HTTP method (GET for example) on a resource/endpoint which it not supports.   ## validation_error The error type **validation_error** is used when there is validation error on the data you provided in the request payload or path. There will be detailed information in the JSON response about the validation error like what exactly went wrong on what field.   ## project_id_mismatch The error type **project_id_mismatch** is used when there is a project ID you provided mismatch.  ## login_error The error type **login_error** is used when the authentication failed. Most common case is that you provided a wrong pair of project ID and API secret. As mentioned above with use HTTP Basic Auth for authentication.  ## invalid_json The error type **invalid_json** is used when you send invalid JSON as request body. There will be detailed information in the JSON response about what went wrong.  ## rate_limited The error type **rate_limited** is used when ran into rate limiting of the Corbado Backend API. Right now you can do a maximum of **2000 requests** within **10 seconds** from a **single IP**. Throttle your requests and try again. If you think you need more contact support@corbado.com.  ## invalid_origin The error type **invalid_origin** is used when the API has been called from a origin which is not authorized (CORS). Add the origin to your project at https://app.corbado.com/app/settings/credentials/authorized-origins.  ## already_exists The error type **already_exists** is used when you try create a resource which already exists. Most common case is that there is some unique constraint on one of the fields.  # Security and privacy Corbado services are designed, developed, monitored, and updated with security at our core to protect you and your customers’ data and privacy.  ## Security  ### Infrastructure security Corbado leverages highly available and secure cloud infrastructure to ensure that our services are always available and securely delivered. Corbado's services are operated in uvensys GmbH's data centers in Germany and comply with ISO standard 27001. All data centers have redundant power and internet connections to avoid failure. The main location of the servers used is in Linden and offers 24/7 support. We do not use any AWS, GCP or Azure services.  Each server is monitored 24/7 and in the event of problems, automated information is sent via SMS and e-mail. The monitoring is done by the external service provider Serverguard24 GmbH.   All Corbado hardware and networking is routinely updated and audited to ensure systems are secure and that least privileged access is followed. Additionally we implement robust logging and audit protocols that allow us high visibility into system use.  ### Responsible disclosure program Here at Corbado, we take the security of our user’s data and of our services seriously. As such, we encourage responsible security research on Corbado services and products. If you believe you’ve discovered a potential vulnerability, please let us know by emailing us at [security@corbado.com](mailto:security@corbado.com). We will acknowledge your email within 2 business days. As public disclosures of a security vulnerability could put the entire Corbado community at risk, we ask that you keep such potential vulnerabilities confidential until we are able to address them. We aim to resolve critical issues within 30 days of disclosure. Please make a good faith effort to avoid violating privacy, destroying data, or interrupting or degrading the Corbado service. Please only interact with accounts you own or for which you have explicit permission from the account holder. While researching, please refrain from:  - Distributed Denial of Service (DDoS) - Spamming - Social engineering or phishing of Corbado employees or contractors - Any attacks against Corbado's physical property or data centers  Thank you for helping to keep Corbado and our users safe!  ### Rate limiting At Corbado, we apply rate limit policies on our APIs in order to protect your application and user management infrastructure, so your users will have a frictionless non-interrupted experience.  Corbado responds with HTTP status code 429 (too many requests) when the rate limits exceed. Your code logic should be able to handle such cases by checking the status code on the response and recovering from such cases. If a retry is needed, it is best to allow for a back-off to avoid going into an infinite retry loop.  The current rate limit for all our API endpoints is **max. 100 requests per 10 seconds**.  ## Privacy Corbado is committed to protecting the personal data of our customers and their customers. Corbado has in place appropriate data security measures that meet industry standards. We regularly review and make enhancements to our processes, products, documentation, and contracts to help support ours and our customers’ compliance for the processing of personal data.  We try to minimize the usage and processing of personally identifiable information. Therefore, all our services are constructed to avoid unnecessary data consumption.  To make our services work, we only require the following data: - any kind of identifier (e.g. UUID, phone number, email address) - IP address (only temporarily for rate limiting aspects) - User agent (for device management)
 *
 * The version of the OpenAPI document: 1.0.0
 * Contact: support@corbado.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 7.2.0-SNAPSHOT
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
 * WebAuthnCredentialItemRsp Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class WebAuthnCredentialItemRsp implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'webAuthnCredentialItemRsp';

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
        'id' => 'string',
        'credential_hash' => 'string',
        'aaguid' => 'string',
        'attestation_type' => 'string',
        'backup_state' => 'bool',
        'backup_eligible' => 'bool',
        'transport' => 'string[]',
        'status' => 'string',
        'user_agent' => 'string',
        'created' => 'string',
        'authenticator_id' => 'string',
        'authenticator_name' => 'string',
        'last_used' => 'string',
        'last_used_device_name' => 'string'
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
        'id' => null,
        'credential_hash' => null,
        'aaguid' => null,
        'attestation_type' => null,
        'backup_state' => null,
        'backup_eligible' => null,
        'transport' => null,
        'status' => null,
        'user_agent' => null,
        'created' => null,
        'authenticator_id' => null,
        'authenticator_name' => null,
        'last_used' => null,
        'last_used_device_name' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'http_status_code' => false,
        'message' => false,
        'request_data' => false,
        'runtime' => false,
        'id' => false,
        'credential_hash' => false,
        'aaguid' => false,
        'attestation_type' => false,
        'backup_state' => false,
        'backup_eligible' => false,
        'transport' => false,
        'status' => false,
        'user_agent' => false,
        'created' => false,
        'authenticator_id' => false,
        'authenticator_name' => false,
        'last_used' => false,
        'last_used_device_name' => false
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
        'http_status_code' => 'httpStatusCode',
        'message' => 'message',
        'request_data' => 'requestData',
        'runtime' => 'runtime',
        'id' => 'id',
        'credential_hash' => 'credentialHash',
        'aaguid' => 'aaguid',
        'attestation_type' => 'attestationType',
        'backup_state' => 'backupState',
        'backup_eligible' => 'backupEligible',
        'transport' => 'transport',
        'status' => 'status',
        'user_agent' => 'userAgent',
        'created' => 'created',
        'authenticator_id' => 'authenticatorID',
        'authenticator_name' => 'authenticatorName',
        'last_used' => 'lastUsed',
        'last_used_device_name' => 'lastUsedDeviceName'
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
        'id' => 'setId',
        'credential_hash' => 'setCredentialHash',
        'aaguid' => 'setAaguid',
        'attestation_type' => 'setAttestationType',
        'backup_state' => 'setBackupState',
        'backup_eligible' => 'setBackupEligible',
        'transport' => 'setTransport',
        'status' => 'setStatus',
        'user_agent' => 'setUserAgent',
        'created' => 'setCreated',
        'authenticator_id' => 'setAuthenticatorId',
        'authenticator_name' => 'setAuthenticatorName',
        'last_used' => 'setLastUsed',
        'last_used_device_name' => 'setLastUsedDeviceName'
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
        'id' => 'getId',
        'credential_hash' => 'getCredentialHash',
        'aaguid' => 'getAaguid',
        'attestation_type' => 'getAttestationType',
        'backup_state' => 'getBackupState',
        'backup_eligible' => 'getBackupEligible',
        'transport' => 'getTransport',
        'status' => 'getStatus',
        'user_agent' => 'getUserAgent',
        'created' => 'getCreated',
        'authenticator_id' => 'getAuthenticatorId',
        'authenticator_name' => 'getAuthenticatorName',
        'last_used' => 'getLastUsed',
        'last_used_device_name' => 'getLastUsedDeviceName'
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

    public const TRANSPORT_USB = 'usb';
    public const TRANSPORT_NFC = 'nfc';
    public const TRANSPORT_BLE = 'ble';
    public const TRANSPORT_INTERNAL = 'internal';
    public const TRANSPORT_HYBRID = 'hybrid';
    public const TRANSPORT_SMART_CARD = 'smart-card';
    public const STATUS_PENDING = 'pending';
    public const STATUS_ACTIVE = 'active';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTransportAllowableValues()
    {
        return [
            self::TRANSPORT_USB,
            self::TRANSPORT_NFC,
            self::TRANSPORT_BLE,
            self::TRANSPORT_INTERNAL,
            self::TRANSPORT_HYBRID,
            self::TRANSPORT_SMART_CARD,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ACTIVE,
        ];
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
        $this->setIfExists('http_status_code', $data ?? [], null);
        $this->setIfExists('message', $data ?? [], null);
        $this->setIfExists('request_data', $data ?? [], null);
        $this->setIfExists('runtime', $data ?? [], null);
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('credential_hash', $data ?? [], null);
        $this->setIfExists('aaguid', $data ?? [], null);
        $this->setIfExists('attestation_type', $data ?? [], null);
        $this->setIfExists('backup_state', $data ?? [], null);
        $this->setIfExists('backup_eligible', $data ?? [], null);
        $this->setIfExists('transport', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('user_agent', $data ?? [], null);
        $this->setIfExists('created', $data ?? [], null);
        $this->setIfExists('authenticator_id', $data ?? [], null);
        $this->setIfExists('authenticator_name', $data ?? [], null);
        $this->setIfExists('last_used', $data ?? [], null);
        $this->setIfExists('last_used_device_name', $data ?? [], null);
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
        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['credential_hash'] === null) {
            $invalidProperties[] = "'credential_hash' can't be null";
        }
        if ($this->container['aaguid'] === null) {
            $invalidProperties[] = "'aaguid' can't be null";
        }
        if ($this->container['attestation_type'] === null) {
            $invalidProperties[] = "'attestation_type' can't be null";
        }
        if ($this->container['backup_eligible'] === null) {
            $invalidProperties[] = "'backup_eligible' can't be null";
        }
        if ($this->container['transport'] === null) {
            $invalidProperties[] = "'transport' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['user_agent'] === null) {
            $invalidProperties[] = "'user_agent' can't be null";
        }
        if ($this->container['created'] === null) {
            $invalidProperties[] = "'created' can't be null";
        }
        if ($this->container['authenticator_id'] === null) {
            $invalidProperties[] = "'authenticator_id' can't be null";
        }
        if ($this->container['authenticator_name'] === null) {
            $invalidProperties[] = "'authenticator_name' can't be null";
        }
        if ($this->container['last_used'] === null) {
            $invalidProperties[] = "'last_used' can't be null";
        }
        if ($this->container['last_used_device_name'] === null) {
            $invalidProperties[] = "'last_used_device_name' can't be null";
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
        if (is_null($http_status_code)) {
            throw new \InvalidArgumentException('non-nullable http_status_code cannot be null');
        }

        if (($http_status_code > 599)) {
            throw new \InvalidArgumentException('invalid value for $http_status_code when calling WebAuthnCredentialItemRsp., must be smaller than or equal to 599.');
        }
        if (($http_status_code < 200)) {
            throw new \InvalidArgumentException('invalid value for $http_status_code when calling WebAuthnCredentialItemRsp., must be bigger than or equal to 200.');
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
        if (is_null($message)) {
            throw new \InvalidArgumentException('non-nullable message cannot be null');
        }
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
        if (is_null($request_data)) {
            throw new \InvalidArgumentException('non-nullable request_data cannot be null');
        }
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
        if (is_null($runtime)) {
            throw new \InvalidArgumentException('non-nullable runtime cannot be null');
        }
        $this->container['runtime'] = $runtime;

        return $this;
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param string $id Credential ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets credential_hash
     *
     * @return string
     */
    public function getCredentialHash()
    {
        return $this->container['credential_hash'];
    }

    /**
     * Sets credential_hash
     *
     * @param string $credential_hash credential_hash
     *
     * @return self
     */
    public function setCredentialHash($credential_hash)
    {
        if (is_null($credential_hash)) {
            throw new \InvalidArgumentException('non-nullable credential_hash cannot be null');
        }
        $this->container['credential_hash'] = $credential_hash;

        return $this;
    }

    /**
     * Gets aaguid
     *
     * @return string
     */
    public function getAaguid()
    {
        return $this->container['aaguid'];
    }

    /**
     * Sets aaguid
     *
     * @param string $aaguid aaguid
     *
     * @return self
     */
    public function setAaguid($aaguid)
    {
        if (is_null($aaguid)) {
            throw new \InvalidArgumentException('non-nullable aaguid cannot be null');
        }
        $this->container['aaguid'] = $aaguid;

        return $this;
    }

    /**
     * Gets attestation_type
     *
     * @return string
     */
    public function getAttestationType()
    {
        return $this->container['attestation_type'];
    }

    /**
     * Sets attestation_type
     *
     * @param string $attestation_type attestation_type
     *
     * @return self
     */
    public function setAttestationType($attestation_type)
    {
        if (is_null($attestation_type)) {
            throw new \InvalidArgumentException('non-nullable attestation_type cannot be null');
        }
        $this->container['attestation_type'] = $attestation_type;

        return $this;
    }

    /**
     * Gets backup_state
     *
     * @return bool|null
     */
    public function getBackupState()
    {
        return $this->container['backup_state'];
    }

    /**
     * Sets backup_state
     *
     * @param bool|null $backup_state Backup state
     *
     * @return self
     */
    public function setBackupState($backup_state)
    {
        if (is_null($backup_state)) {
            throw new \InvalidArgumentException('non-nullable backup_state cannot be null');
        }
        $this->container['backup_state'] = $backup_state;

        return $this;
    }

    /**
     * Gets backup_eligible
     *
     * @return bool
     */
    public function getBackupEligible()
    {
        return $this->container['backup_eligible'];
    }

    /**
     * Sets backup_eligible
     *
     * @param bool $backup_eligible Backup eligible
     *
     * @return self
     */
    public function setBackupEligible($backup_eligible)
    {
        if (is_null($backup_eligible)) {
            throw new \InvalidArgumentException('non-nullable backup_eligible cannot be null');
        }
        $this->container['backup_eligible'] = $backup_eligible;

        return $this;
    }

    /**
     * Gets transport
     *
     * @return string[]
     */
    public function getTransport()
    {
        return $this->container['transport'];
    }

    /**
     * Sets transport
     *
     * @param string[] $transport Transport
     *
     * @return self
     */
    public function setTransport($transport)
    {
        if (is_null($transport)) {
            throw new \InvalidArgumentException('non-nullable transport cannot be null');
        }
        $allowedValues = $this->getTransportAllowableValues();
        if (array_diff($transport, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'transport', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['transport'] = $transport;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets user_agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        return $this->container['user_agent'];
    }

    /**
     * Sets user_agent
     *
     * @param string $user_agent User agent
     *
     * @return self
     */
    public function setUserAgent($user_agent)
    {
        if (is_null($user_agent)) {
            throw new \InvalidArgumentException('non-nullable user_agent cannot be null');
        }
        $this->container['user_agent'] = $user_agent;

        return $this;
    }

    /**
     * Gets created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param string $created Timestamp of when the entity was created in yyyy-MM-dd'T'HH:mm:ss format
     *
     * @return self
     */
    public function setCreated($created)
    {
        if (is_null($created)) {
            throw new \InvalidArgumentException('non-nullable created cannot be null');
        }
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets authenticator_id
     *
     * @return string
     */
    public function getAuthenticatorId()
    {
        return $this->container['authenticator_id'];
    }

    /**
     * Sets authenticator_id
     *
     * @param string $authenticator_id Authenticator ID
     *
     * @return self
     */
    public function setAuthenticatorId($authenticator_id)
    {
        if (is_null($authenticator_id)) {
            throw new \InvalidArgumentException('non-nullable authenticator_id cannot be null');
        }
        $this->container['authenticator_id'] = $authenticator_id;

        return $this;
    }

    /**
     * Gets authenticator_name
     *
     * @return string
     */
    public function getAuthenticatorName()
    {
        return $this->container['authenticator_name'];
    }

    /**
     * Sets authenticator_name
     *
     * @param string $authenticator_name authenticator_name
     *
     * @return self
     */
    public function setAuthenticatorName($authenticator_name)
    {
        if (is_null($authenticator_name)) {
            throw new \InvalidArgumentException('non-nullable authenticator_name cannot be null');
        }
        $this->container['authenticator_name'] = $authenticator_name;

        return $this;
    }

    /**
     * Gets last_used
     *
     * @return string
     */
    public function getLastUsed()
    {
        return $this->container['last_used'];
    }

    /**
     * Sets last_used
     *
     * @param string $last_used Timestamp of when the passkey was last used in yyyy-MM-dd'T'HH:mm:ss format
     *
     * @return self
     */
    public function setLastUsed($last_used)
    {
        if (is_null($last_used)) {
            throw new \InvalidArgumentException('non-nullable last_used cannot be null');
        }
        $this->container['last_used'] = $last_used;

        return $this;
    }

    /**
     * Gets last_used_device_name
     *
     * @return string
     */
    public function getLastUsedDeviceName()
    {
        return $this->container['last_used_device_name'];
    }

    /**
     * Sets last_used_device_name
     *
     * @param string $last_used_device_name last_used_device_name
     *
     * @return self
     */
    public function setLastUsedDeviceName($last_used_device_name)
    {
        if (is_null($last_used_device_name)) {
            throw new \InvalidArgumentException('non-nullable last_used_device_name cannot be null');
        }
        $this->container['last_used_device_name'] = $last_used_device_name;

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


