<?php
/**
 * SessionConfigUpdateReq
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
 * OpenAPI Generator version: 6.6.0
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
 * SessionConfigUpdateReq Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class SessionConfigUpdateReq implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'sessionConfigUpdateReq';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'version' => 'string',
        'active' => 'bool',
        'short_lifetime_minutes' => 'int',
        'short_cookie_domain' => 'string',
        'short_cookie_secure' => 'bool',
        'short_cookie_same_site' => 'string',
        'long_lifetime_value' => 'int',
        'long_lifetime_unit' => 'string',
        'long_inactivity_value' => 'int',
        'long_inactivity_unit' => 'string',
        'request_id' => 'string',
        'client_info' => '\Corbado\Generated\Model\ClientInfo'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'version' => null,
        'active' => null,
        'short_lifetime_minutes' => null,
        'short_cookie_domain' => null,
        'short_cookie_secure' => null,
        'short_cookie_same_site' => null,
        'long_lifetime_value' => null,
        'long_lifetime_unit' => null,
        'long_inactivity_value' => null,
        'long_inactivity_unit' => null,
        'request_id' => null,
        'client_info' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'version' => false,
		'active' => false,
		'short_lifetime_minutes' => false,
		'short_cookie_domain' => false,
		'short_cookie_secure' => false,
		'short_cookie_same_site' => false,
		'long_lifetime_value' => false,
		'long_lifetime_unit' => false,
		'long_inactivity_value' => false,
		'long_inactivity_unit' => false,
		'request_id' => false,
		'client_info' => false
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
        'version' => 'version',
        'active' => 'active',
        'short_lifetime_minutes' => 'shortLifetimeMinutes',
        'short_cookie_domain' => 'shortCookieDomain',
        'short_cookie_secure' => 'shortCookieSecure',
        'short_cookie_same_site' => 'shortCookieSameSite',
        'long_lifetime_value' => 'longLifetimeValue',
        'long_lifetime_unit' => 'longLifetimeUnit',
        'long_inactivity_value' => 'longInactivityValue',
        'long_inactivity_unit' => 'longInactivityUnit',
        'request_id' => 'requestID',
        'client_info' => 'clientInfo'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'version' => 'setVersion',
        'active' => 'setActive',
        'short_lifetime_minutes' => 'setShortLifetimeMinutes',
        'short_cookie_domain' => 'setShortCookieDomain',
        'short_cookie_secure' => 'setShortCookieSecure',
        'short_cookie_same_site' => 'setShortCookieSameSite',
        'long_lifetime_value' => 'setLongLifetimeValue',
        'long_lifetime_unit' => 'setLongLifetimeUnit',
        'long_inactivity_value' => 'setLongInactivityValue',
        'long_inactivity_unit' => 'setLongInactivityUnit',
        'request_id' => 'setRequestId',
        'client_info' => 'setClientInfo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'version' => 'getVersion',
        'active' => 'getActive',
        'short_lifetime_minutes' => 'getShortLifetimeMinutes',
        'short_cookie_domain' => 'getShortCookieDomain',
        'short_cookie_secure' => 'getShortCookieSecure',
        'short_cookie_same_site' => 'getShortCookieSameSite',
        'long_lifetime_value' => 'getLongLifetimeValue',
        'long_lifetime_unit' => 'getLongLifetimeUnit',
        'long_inactivity_value' => 'getLongInactivityValue',
        'long_inactivity_unit' => 'getLongInactivityUnit',
        'request_id' => 'getRequestId',
        'client_info' => 'getClientInfo'
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

    public const SHORT_COOKIE_SAME_SITE_LAX = 'lax';
    public const SHORT_COOKIE_SAME_SITE_STRICT = 'strict';
    public const SHORT_COOKIE_SAME_SITE_NONE = 'none';
    public const LONG_LIFETIME_UNIT_MIN = 'min';
    public const LONG_LIFETIME_UNIT_HOUR = 'hour';
    public const LONG_INACTIVITY_UNIT_MIN = 'min';
    public const LONG_INACTIVITY_UNIT_HOUR = 'hour';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getShortCookieSameSiteAllowableValues()
    {
        return [
            self::SHORT_COOKIE_SAME_SITE_LAX,
            self::SHORT_COOKIE_SAME_SITE_STRICT,
            self::SHORT_COOKIE_SAME_SITE_NONE,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLongLifetimeUnitAllowableValues()
    {
        return [
            self::LONG_LIFETIME_UNIT_MIN,
            self::LONG_LIFETIME_UNIT_HOUR,
        ];
    }

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getLongInactivityUnitAllowableValues()
    {
        return [
            self::LONG_INACTIVITY_UNIT_MIN,
            self::LONG_INACTIVITY_UNIT_HOUR,
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
        $this->setIfExists('version', $data ?? [], null);
        $this->setIfExists('active', $data ?? [], null);
        $this->setIfExists('short_lifetime_minutes', $data ?? [], null);
        $this->setIfExists('short_cookie_domain', $data ?? [], null);
        $this->setIfExists('short_cookie_secure', $data ?? [], null);
        $this->setIfExists('short_cookie_same_site', $data ?? [], null);
        $this->setIfExists('long_lifetime_value', $data ?? [], null);
        $this->setIfExists('long_lifetime_unit', $data ?? [], null);
        $this->setIfExists('long_inactivity_value', $data ?? [], null);
        $this->setIfExists('long_inactivity_unit', $data ?? [], null);
        $this->setIfExists('request_id', $data ?? [], null);
        $this->setIfExists('client_info', $data ?? [], null);
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

        $allowedValues = $this->getShortCookieSameSiteAllowableValues();
        if (!is_null($this->container['short_cookie_same_site']) && !in_array($this->container['short_cookie_same_site'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'short_cookie_same_site', must be one of '%s'",
                $this->container['short_cookie_same_site'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getLongLifetimeUnitAllowableValues();
        if (!is_null($this->container['long_lifetime_unit']) && !in_array($this->container['long_lifetime_unit'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'long_lifetime_unit', must be one of '%s'",
                $this->container['long_lifetime_unit'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getLongInactivityUnitAllowableValues();
        if (!is_null($this->container['long_inactivity_unit']) && !in_array($this->container['long_inactivity_unit'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'long_inactivity_unit', must be one of '%s'",
                $this->container['long_inactivity_unit'],
                implode("', '", $allowedValues)
            );
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
     * Gets version
     *
     * @return string|null
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param string|null $version version
     *
     * @return self
     */
    public function setVersion($version)
    {
        if (is_null($version)) {
            throw new \InvalidArgumentException('non-nullable version cannot be null');
        }
        $this->container['version'] = $version;

        return $this;
    }

    /**
     * Gets active
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->container['active'];
    }

    /**
     * Sets active
     *
     * @param bool|null $active active
     *
     * @return self
     */
    public function setActive($active)
    {
        if (is_null($active)) {
            throw new \InvalidArgumentException('non-nullable active cannot be null');
        }
        $this->container['active'] = $active;

        return $this;
    }

    /**
     * Gets short_lifetime_minutes
     *
     * @return int|null
     */
    public function getShortLifetimeMinutes()
    {
        return $this->container['short_lifetime_minutes'];
    }

    /**
     * Sets short_lifetime_minutes
     *
     * @param int|null $short_lifetime_minutes short_lifetime_minutes
     *
     * @return self
     */
    public function setShortLifetimeMinutes($short_lifetime_minutes)
    {
        if (is_null($short_lifetime_minutes)) {
            throw new \InvalidArgumentException('non-nullable short_lifetime_minutes cannot be null');
        }
        $this->container['short_lifetime_minutes'] = $short_lifetime_minutes;

        return $this;
    }

    /**
     * Gets short_cookie_domain
     *
     * @return string|null
     */
    public function getShortCookieDomain()
    {
        return $this->container['short_cookie_domain'];
    }

    /**
     * Sets short_cookie_domain
     *
     * @param string|null $short_cookie_domain short_cookie_domain
     *
     * @return self
     */
    public function setShortCookieDomain($short_cookie_domain)
    {
        if (is_null($short_cookie_domain)) {
            throw new \InvalidArgumentException('non-nullable short_cookie_domain cannot be null');
        }
        $this->container['short_cookie_domain'] = $short_cookie_domain;

        return $this;
    }

    /**
     * Gets short_cookie_secure
     *
     * @return bool|null
     */
    public function getShortCookieSecure()
    {
        return $this->container['short_cookie_secure'];
    }

    /**
     * Sets short_cookie_secure
     *
     * @param bool|null $short_cookie_secure short_cookie_secure
     *
     * @return self
     */
    public function setShortCookieSecure($short_cookie_secure)
    {
        if (is_null($short_cookie_secure)) {
            throw new \InvalidArgumentException('non-nullable short_cookie_secure cannot be null');
        }
        $this->container['short_cookie_secure'] = $short_cookie_secure;

        return $this;
    }

    /**
     * Gets short_cookie_same_site
     *
     * @return string|null
     */
    public function getShortCookieSameSite()
    {
        return $this->container['short_cookie_same_site'];
    }

    /**
     * Sets short_cookie_same_site
     *
     * @param string|null $short_cookie_same_site short_cookie_same_site
     *
     * @return self
     */
    public function setShortCookieSameSite($short_cookie_same_site)
    {
        if (is_null($short_cookie_same_site)) {
            throw new \InvalidArgumentException('non-nullable short_cookie_same_site cannot be null');
        }
        $allowedValues = $this->getShortCookieSameSiteAllowableValues();
        if (!in_array($short_cookie_same_site, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'short_cookie_same_site', must be one of '%s'",
                    $short_cookie_same_site,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['short_cookie_same_site'] = $short_cookie_same_site;

        return $this;
    }

    /**
     * Gets long_lifetime_value
     *
     * @return int|null
     */
    public function getLongLifetimeValue()
    {
        return $this->container['long_lifetime_value'];
    }

    /**
     * Sets long_lifetime_value
     *
     * @param int|null $long_lifetime_value long_lifetime_value
     *
     * @return self
     */
    public function setLongLifetimeValue($long_lifetime_value)
    {
        if (is_null($long_lifetime_value)) {
            throw new \InvalidArgumentException('non-nullable long_lifetime_value cannot be null');
        }
        $this->container['long_lifetime_value'] = $long_lifetime_value;

        return $this;
    }

    /**
     * Gets long_lifetime_unit
     *
     * @return string|null
     */
    public function getLongLifetimeUnit()
    {
        return $this->container['long_lifetime_unit'];
    }

    /**
     * Sets long_lifetime_unit
     *
     * @param string|null $long_lifetime_unit long_lifetime_unit
     *
     * @return self
     */
    public function setLongLifetimeUnit($long_lifetime_unit)
    {
        if (is_null($long_lifetime_unit)) {
            throw new \InvalidArgumentException('non-nullable long_lifetime_unit cannot be null');
        }
        $allowedValues = $this->getLongLifetimeUnitAllowableValues();
        if (!in_array($long_lifetime_unit, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'long_lifetime_unit', must be one of '%s'",
                    $long_lifetime_unit,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['long_lifetime_unit'] = $long_lifetime_unit;

        return $this;
    }

    /**
     * Gets long_inactivity_value
     *
     * @return int|null
     */
    public function getLongInactivityValue()
    {
        return $this->container['long_inactivity_value'];
    }

    /**
     * Sets long_inactivity_value
     *
     * @param int|null $long_inactivity_value long_inactivity_value
     *
     * @return self
     */
    public function setLongInactivityValue($long_inactivity_value)
    {
        if (is_null($long_inactivity_value)) {
            throw new \InvalidArgumentException('non-nullable long_inactivity_value cannot be null');
        }
        $this->container['long_inactivity_value'] = $long_inactivity_value;

        return $this;
    }

    /**
     * Gets long_inactivity_unit
     *
     * @return string|null
     */
    public function getLongInactivityUnit()
    {
        return $this->container['long_inactivity_unit'];
    }

    /**
     * Sets long_inactivity_unit
     *
     * @param string|null $long_inactivity_unit long_inactivity_unit
     *
     * @return self
     */
    public function setLongInactivityUnit($long_inactivity_unit)
    {
        if (is_null($long_inactivity_unit)) {
            throw new \InvalidArgumentException('non-nullable long_inactivity_unit cannot be null');
        }
        $allowedValues = $this->getLongInactivityUnitAllowableValues();
        if (!in_array($long_inactivity_unit, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'long_inactivity_unit', must be one of '%s'",
                    $long_inactivity_unit,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['long_inactivity_unit'] = $long_inactivity_unit;

        return $this;
    }

    /**
     * Gets request_id
     *
     * @return string|null
     */
    public function getRequestId()
    {
        return $this->container['request_id'];
    }

    /**
     * Sets request_id
     *
     * @param string|null $request_id Unique ID of request, you can provide your own while making the request, if not the ID will be randomly generated on server side
     *
     * @return self
     */
    public function setRequestId($request_id)
    {
        if (is_null($request_id)) {
            throw new \InvalidArgumentException('non-nullable request_id cannot be null');
        }
        $this->container['request_id'] = $request_id;

        return $this;
    }

    /**
     * Gets client_info
     *
     * @return \Corbado\Generated\Model\ClientInfo|null
     */
    public function getClientInfo()
    {
        return $this->container['client_info'];
    }

    /**
     * Sets client_info
     *
     * @param \Corbado\Generated\Model\ClientInfo|null $client_info client_info
     *
     * @return self
     */
    public function setClientInfo($client_info)
    {
        if (is_null($client_info)) {
            throw new \InvalidArgumentException('non-nullable client_info cannot be null');
        }
        $this->container['client_info'] = $client_info;

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


