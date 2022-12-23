<?php
/**
 * ProjectConfigSaveReq
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
 * ProjectConfigSaveReq Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ProjectConfigSaveReq implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'projectConfigSaveReq';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'external_name' => 'string',
        'email_from' => 'string',
        'sms_from' => 'string',
        'external_application_username' => 'string',
        'external_application_password' => 'string',
        'legacy_auth_methods_url' => 'string',
        'password_verify_url' => 'string',
        'auth_success_redirect_url' => 'string',
        'password_reset_url' => 'string',
        'allow_user_registration' => 'bool',
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
        'external_name' => null,
        'email_from' => null,
        'sms_from' => null,
        'external_application_username' => null,
        'external_application_password' => null,
        'legacy_auth_methods_url' => null,
        'password_verify_url' => null,
        'auth_success_redirect_url' => null,
        'password_reset_url' => null,
        'allow_user_registration' => null,
        'request_id' => null,
        'client_info' => null
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
        'external_name' => 'externalName',
        'email_from' => 'emailFrom',
        'sms_from' => 'smsFrom',
        'external_application_username' => 'externalApplicationUsername',
        'external_application_password' => 'externalApplicationPassword',
        'legacy_auth_methods_url' => 'legacyAuthMethodsUrl',
        'password_verify_url' => 'passwordVerifyUrl',
        'auth_success_redirect_url' => 'authSuccessRedirectUrl',
        'password_reset_url' => 'passwordResetUrl',
        'allow_user_registration' => 'allowUserRegistration',
        'request_id' => 'requestID',
        'client_info' => 'clientInfo'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'external_name' => 'setExternalName',
        'email_from' => 'setEmailFrom',
        'sms_from' => 'setSmsFrom',
        'external_application_username' => 'setExternalApplicationUsername',
        'external_application_password' => 'setExternalApplicationPassword',
        'legacy_auth_methods_url' => 'setLegacyAuthMethodsUrl',
        'password_verify_url' => 'setPasswordVerifyUrl',
        'auth_success_redirect_url' => 'setAuthSuccessRedirectUrl',
        'password_reset_url' => 'setPasswordResetUrl',
        'allow_user_registration' => 'setAllowUserRegistration',
        'request_id' => 'setRequestId',
        'client_info' => 'setClientInfo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'external_name' => 'getExternalName',
        'email_from' => 'getEmailFrom',
        'sms_from' => 'getSmsFrom',
        'external_application_username' => 'getExternalApplicationUsername',
        'external_application_password' => 'getExternalApplicationPassword',
        'legacy_auth_methods_url' => 'getLegacyAuthMethodsUrl',
        'password_verify_url' => 'getPasswordVerifyUrl',
        'auth_success_redirect_url' => 'getAuthSuccessRedirectUrl',
        'password_reset_url' => 'getPasswordResetUrl',
        'allow_user_registration' => 'getAllowUserRegistration',
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
        $this->container['external_name'] = $data['external_name'] ?? null;
        $this->container['email_from'] = $data['email_from'] ?? null;
        $this->container['sms_from'] = $data['sms_from'] ?? null;
        $this->container['external_application_username'] = $data['external_application_username'] ?? null;
        $this->container['external_application_password'] = $data['external_application_password'] ?? null;
        $this->container['legacy_auth_methods_url'] = $data['legacy_auth_methods_url'] ?? null;
        $this->container['password_verify_url'] = $data['password_verify_url'] ?? null;
        $this->container['auth_success_redirect_url'] = $data['auth_success_redirect_url'] ?? null;
        $this->container['password_reset_url'] = $data['password_reset_url'] ?? null;
        $this->container['allow_user_registration'] = $data['allow_user_registration'] ?? null;
        $this->container['request_id'] = $data['request_id'] ?? null;
        $this->container['client_info'] = $data['client_info'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['external_name'] === null) {
            $invalidProperties[] = "'external_name' can't be null";
        }
        if ($this->container['email_from'] === null) {
            $invalidProperties[] = "'email_from' can't be null";
        }
        if ($this->container['sms_from'] === null) {
            $invalidProperties[] = "'sms_from' can't be null";
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
     * Gets external_name
     *
     * @return string
     */
    public function getExternalName()
    {
        return $this->container['external_name'];
    }

    /**
     * Sets external_name
     *
     * @param string $external_name external_name
     *
     * @return self
     */
    public function setExternalName($external_name)
    {
        $this->container['external_name'] = $external_name;

        return $this;
    }

    /**
     * Gets email_from
     *
     * @return string
     */
    public function getEmailFrom()
    {
        return $this->container['email_from'];
    }

    /**
     * Sets email_from
     *
     * @param string $email_from email_from
     *
     * @return self
     */
    public function setEmailFrom($email_from)
    {
        $this->container['email_from'] = $email_from;

        return $this;
    }

    /**
     * Gets sms_from
     *
     * @return string
     */
    public function getSmsFrom()
    {
        return $this->container['sms_from'];
    }

    /**
     * Sets sms_from
     *
     * @param string $sms_from sms_from
     *
     * @return self
     */
    public function setSmsFrom($sms_from)
    {
        $this->container['sms_from'] = $sms_from;

        return $this;
    }

    /**
     * Gets external_application_username
     *
     * @return string|null
     */
    public function getExternalApplicationUsername()
    {
        return $this->container['external_application_username'];
    }

    /**
     * Sets external_application_username
     *
     * @param string|null $external_application_username external_application_username
     *
     * @return self
     */
    public function setExternalApplicationUsername($external_application_username)
    {
        $this->container['external_application_username'] = $external_application_username;

        return $this;
    }

    /**
     * Gets external_application_password
     *
     * @return string|null
     */
    public function getExternalApplicationPassword()
    {
        return $this->container['external_application_password'];
    }

    /**
     * Sets external_application_password
     *
     * @param string|null $external_application_password external_application_password
     *
     * @return self
     */
    public function setExternalApplicationPassword($external_application_password)
    {
        $this->container['external_application_password'] = $external_application_password;

        return $this;
    }

    /**
     * Gets legacy_auth_methods_url
     *
     * @return string|null
     */
    public function getLegacyAuthMethodsUrl()
    {
        return $this->container['legacy_auth_methods_url'];
    }

    /**
     * Sets legacy_auth_methods_url
     *
     * @param string|null $legacy_auth_methods_url legacy_auth_methods_url
     *
     * @return self
     */
    public function setLegacyAuthMethodsUrl($legacy_auth_methods_url)
    {
        $this->container['legacy_auth_methods_url'] = $legacy_auth_methods_url;

        return $this;
    }

    /**
     * Gets password_verify_url
     *
     * @return string|null
     */
    public function getPasswordVerifyUrl()
    {
        return $this->container['password_verify_url'];
    }

    /**
     * Sets password_verify_url
     *
     * @param string|null $password_verify_url password_verify_url
     *
     * @return self
     */
    public function setPasswordVerifyUrl($password_verify_url)
    {
        $this->container['password_verify_url'] = $password_verify_url;

        return $this;
    }

    /**
     * Gets auth_success_redirect_url
     *
     * @return string|null
     */
    public function getAuthSuccessRedirectUrl()
    {
        return $this->container['auth_success_redirect_url'];
    }

    /**
     * Sets auth_success_redirect_url
     *
     * @param string|null $auth_success_redirect_url auth_success_redirect_url
     *
     * @return self
     */
    public function setAuthSuccessRedirectUrl($auth_success_redirect_url)
    {
        $this->container['auth_success_redirect_url'] = $auth_success_redirect_url;

        return $this;
    }

    /**
     * Gets password_reset_url
     *
     * @return string|null
     */
    public function getPasswordResetUrl()
    {
        return $this->container['password_reset_url'];
    }

    /**
     * Sets password_reset_url
     *
     * @param string|null $password_reset_url password_reset_url
     *
     * @return self
     */
    public function setPasswordResetUrl($password_reset_url)
    {
        $this->container['password_reset_url'] = $password_reset_url;

        return $this;
    }

    /**
     * Gets allow_user_registration
     *
     * @return bool|null
     */
    public function getAllowUserRegistration()
    {
        return $this->container['allow_user_registration'];
    }

    /**
     * Sets allow_user_registration
     *
     * @param bool|null $allow_user_registration allow_user_registration
     *
     * @return self
     */
    public function setAllowUserRegistration($allow_user_registration)
    {
        $this->container['allow_user_registration'] = $allow_user_registration;

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


