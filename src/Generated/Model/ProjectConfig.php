<?php
/**
 * ProjectConfig
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
 * # Introduction This documentation gives an overview of all Corbado API calls to implement passwordless authentication with Passkeys (Biometrics).  The Corbado API is organized around REST principles. It uses resource-oriented URLs with verbs (HTTP methods) and HTTP status codes. Requests need to be valid JSON payloads. We always return JSON.  The Corbado API specification is written in **OpenAPI Version 3.0.3**. You can download it via the download button at the top and use it to generate clients in languages we do not provide officially for example.  # Authentication To authenticate your API requests HTTP Basic Auth is used.  You need to set the projectID as username and the API secret as password. The authorization header looks as follows:  `Basic <<projectID>:<API secret>>`  The **authorization header** needs to be **Base64 encoded** to be working. If the authorization header is missing or incorrect, the API will respond with status code 401.  # Error types As mentioned above we make use of HTTP status codes. **4xx** errors indicate so called client errors, meaning the error occurred on client side and you need to fix it. **5xx** errors indicate server errors, which means the error occurred on server side and outside your control.  Besides HTTP status codes Corbado uses what we call error types which gives more details in error cases and help you to debug your request.  ## internal_error The error type **internal_error** is used when some internal error occurred at Corbado. You can retry your request but usually there is nothing you can do about it. All internal errors get logged and will triggert an alert to our operations team which takes care of the situation as soon as possible.  ## not_found The error type **not_found** is used when you try to get a resource which cannot be found. Most common case is that you provided a wrong ID.  ## method_not_allowed The error type **method_not_allowed** is used when you use a HTTP method (GET for example) on a resource/endpoint which it not supports.   ## validation_error The error type **validation_error** is used when there is validation error on the data you provided in the request payload or path. There will be detailed information in the JSON response about the validation error like what exactly went wrong on what field.   ## project_id_mismatch The error type **project_id_mismatch** is used when there is a project ID you provided mismatch.  ## login_error The error type **login_error** is used when the authentication failed. Most common case is that you provided a wrong pair of project ID and API secret. As mentioned above with use HTTP Basic Auth for authentication.  ## invalid_json The error type **invalid_json** is used when you send invalid JSON as request body. There will be detailed information in the JSON response about what went wrong.  ## rate_limited The error type **rate_limited** is used when ran into rate limiting of the Corbado API. Right now you can do a maximum of **2000 requests** within **10 seconds** from a **single IP**. Throttle your requests and try again. If you think you need more contact support@corbado.com.  ## invalid_origin The error type **invalid_origin** is used when the API has been called from a origin which is not authorized (CORS). Add the origin to your project at https://app.corbado.com/app/settings/restapi#origins.  ## already_exists The error type **already_exists** is used when you try create a resource which already exists. Most common case is that there is some unique constraint on one of the fields.  # Security and privacy Corbado services are designed, developed, monitored, and updated with security at our core to protect you and your customers’ data and privacy.  ## Security  ### Infrastructure security Corbado leverages highly available and secure cloud infrastructure to ensure that our services are always available and securely delivered. Corbado's services are operated in uvensyse GmbH's data centers in Germany and comply with ISO standard 27001. All data centers have redundant power and internet connections to avoid failure. The main location of the servers used is in Linden and offers 24/7 support. We do not use any AWS, GCP or Azure services.  Each server is monitored 24/7 and in the event of problems, automated information is sent via SMS and e-mail. The monitoring is done by the external service provider Serverguard24 GmbH.   All Corbado hardware and networking is routinely updated and audited to ensure systems are secure and that least privileged access is followed. Additionally we implement robust logging and audit protocols that allow us high visibility into system use.  ### Responsible disclosure program Here at Corbado, we take the security of our user’s data and of our services seriously. As such, we encourage responsible security research on Corbado services and products. If you believe you’ve discovered a potential vulnerability, please let us know by emailing us at [security@corbado.com](mailto:security@corbado.com). We will acknowledge your email within 2 business days. As public disclosures of a security vulnerability could put the entire Corbado community at risk, we ask that you keep such potential vulnerabilities confidential until we are able to address them. We aim to resolve critical issues within 30 days of disclosure. Please make a good faith effort to avoid violating privacy, destroying data, or interrupting or degrading the Corbado service. Please only interact with accounts you own or for which you have explicit permission from the account holder. While researching, please refrain from:  - Distributed Denial of Service (DDoS) - Spamming - Social engineering or phishing of Corbado employees or contractors - Any attacks against Corbado's physical property or data centers  Thank you for helping to keep Corbado and our users safe!  ### Rate limiting At Corbado, we apply rate limit policies on our APIs in order to protect your application and user management infrastructure, so your users will have a frictionless non-interrupted experience.  Corbado responds with HTTP status code 429 (too many requests) when the rate limits exceed. Your code logic should be able to handle such cases by checking the status code on the response and recovering from such cases. If a retry is needed, it is best to allow for a back-off to avoid going into an infinite retry loop.  The current rate limit for all our API endpoints is **max. 100 requests per 10 seconds**.  ## Privacy Corbado is committed to protecting the personal data of our customers and their customers. Corbado has in place appropriate data security measures that meet industry standards. We regularly review and make enhancements to our processes, products, documentation, and contracts to help support ours and our customers’ compliance for the processing of personal data.  We try to minimize the usage and processing of personally identifiable information. Therefore, all our services are constructed to avoid unnecessary data consumption.  To make our services work, we only require the following data: - any kind of identifier (e.g. UUID, phone number, email address) - IP address (only temporarily for rate limiting aspects) - User agent (for device management)
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
 * ProjectConfig Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ProjectConfig implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'projectConfig';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'project_id' => 'string',
        'external_name' => 'string',
        'email_from' => 'string',
        'sms_from' => 'string',
        'external_application_protocol_version' => 'string',
        'webhook_url' => 'string',
        'webhook_username' => 'string',
        'webhook_password' => 'string',
        'webhook_test_invalid_username' => 'string',
        'webhook_test_valid_username' => 'string',
        'webhook_test_valid_password' => 'string',
        'external_application_username' => 'string',
        'external_application_password' => 'string',
        'legacy_auth_methods_url' => 'string',
        'password_verify_url' => 'string',
        'auth_success_redirect_url' => 'string',
        'password_reset_url' => 'string',
        'allow_user_registration' => 'bool',
        'allow_ip_stickiness' => 'bool',
        'passkey_append_interval' => 'string',
        'cli_secret' => 'string',
        'fallback_language' => 'string',
        'auto_detect_language' => 'bool',
        'integration_mode_hosted' => 'bool',
        'integration_mode_api' => 'bool',
        'integration_mode_web_component' => 'bool',
        'has_existing_users' => 'bool',
        'application_url' => 'string',
        'use_cli' => 'bool',
        'created' => 'string',
        'updated' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'project_id' => null,
        'external_name' => null,
        'email_from' => null,
        'sms_from' => null,
        'external_application_protocol_version' => null,
        'webhook_url' => null,
        'webhook_username' => null,
        'webhook_password' => null,
        'webhook_test_invalid_username' => null,
        'webhook_test_valid_username' => null,
        'webhook_test_valid_password' => null,
        'external_application_username' => null,
        'external_application_password' => null,
        'legacy_auth_methods_url' => null,
        'password_verify_url' => null,
        'auth_success_redirect_url' => null,
        'password_reset_url' => null,
        'allow_user_registration' => null,
        'allow_ip_stickiness' => null,
        'passkey_append_interval' => null,
        'cli_secret' => null,
        'fallback_language' => null,
        'auto_detect_language' => null,
        'integration_mode_hosted' => null,
        'integration_mode_api' => null,
        'integration_mode_web_component' => null,
        'has_existing_users' => null,
        'application_url' => null,
        'use_cli' => null,
        'created' => null,
        'updated' => null
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
        'project_id' => 'projectID',
        'external_name' => 'externalName',
        'email_from' => 'emailFrom',
        'sms_from' => 'smsFrom',
        'external_application_protocol_version' => 'externalApplicationProtocolVersion',
        'webhook_url' => 'webhookURL',
        'webhook_username' => 'webhookUsername',
        'webhook_password' => 'webhookPassword',
        'webhook_test_invalid_username' => 'webhookTestInvalidUsername',
        'webhook_test_valid_username' => 'webhookTestValidUsername',
        'webhook_test_valid_password' => 'webhookTestValidPassword',
        'external_application_username' => 'externalApplicationUsername',
        'external_application_password' => 'externalApplicationPassword',
        'legacy_auth_methods_url' => 'legacyAuthMethodsUrl',
        'password_verify_url' => 'passwordVerifyUrl',
        'auth_success_redirect_url' => 'authSuccessRedirectUrl',
        'password_reset_url' => 'passwordResetUrl',
        'allow_user_registration' => 'allowUserRegistration',
        'allow_ip_stickiness' => 'allowIPStickiness',
        'passkey_append_interval' => 'passkeyAppendInterval',
        'cli_secret' => 'cliSecret',
        'fallback_language' => 'fallbackLanguage',
        'auto_detect_language' => 'autoDetectLanguage',
        'integration_mode_hosted' => 'integrationModeHosted',
        'integration_mode_api' => 'integrationModeAPI',
        'integration_mode_web_component' => 'integrationModeWebComponent',
        'has_existing_users' => 'hasExistingUsers',
        'application_url' => 'applicationUrl',
        'use_cli' => 'useCli',
        'created' => 'created',
        'updated' => 'updated'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'project_id' => 'setProjectId',
        'external_name' => 'setExternalName',
        'email_from' => 'setEmailFrom',
        'sms_from' => 'setSmsFrom',
        'external_application_protocol_version' => 'setExternalApplicationProtocolVersion',
        'webhook_url' => 'setWebhookUrl',
        'webhook_username' => 'setWebhookUsername',
        'webhook_password' => 'setWebhookPassword',
        'webhook_test_invalid_username' => 'setWebhookTestInvalidUsername',
        'webhook_test_valid_username' => 'setWebhookTestValidUsername',
        'webhook_test_valid_password' => 'setWebhookTestValidPassword',
        'external_application_username' => 'setExternalApplicationUsername',
        'external_application_password' => 'setExternalApplicationPassword',
        'legacy_auth_methods_url' => 'setLegacyAuthMethodsUrl',
        'password_verify_url' => 'setPasswordVerifyUrl',
        'auth_success_redirect_url' => 'setAuthSuccessRedirectUrl',
        'password_reset_url' => 'setPasswordResetUrl',
        'allow_user_registration' => 'setAllowUserRegistration',
        'allow_ip_stickiness' => 'setAllowIpStickiness',
        'passkey_append_interval' => 'setPasskeyAppendInterval',
        'cli_secret' => 'setCliSecret',
        'fallback_language' => 'setFallbackLanguage',
        'auto_detect_language' => 'setAutoDetectLanguage',
        'integration_mode_hosted' => 'setIntegrationModeHosted',
        'integration_mode_api' => 'setIntegrationModeApi',
        'integration_mode_web_component' => 'setIntegrationModeWebComponent',
        'has_existing_users' => 'setHasExistingUsers',
        'application_url' => 'setApplicationUrl',
        'use_cli' => 'setUseCli',
        'created' => 'setCreated',
        'updated' => 'setUpdated'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'project_id' => 'getProjectId',
        'external_name' => 'getExternalName',
        'email_from' => 'getEmailFrom',
        'sms_from' => 'getSmsFrom',
        'external_application_protocol_version' => 'getExternalApplicationProtocolVersion',
        'webhook_url' => 'getWebhookUrl',
        'webhook_username' => 'getWebhookUsername',
        'webhook_password' => 'getWebhookPassword',
        'webhook_test_invalid_username' => 'getWebhookTestInvalidUsername',
        'webhook_test_valid_username' => 'getWebhookTestValidUsername',
        'webhook_test_valid_password' => 'getWebhookTestValidPassword',
        'external_application_username' => 'getExternalApplicationUsername',
        'external_application_password' => 'getExternalApplicationPassword',
        'legacy_auth_methods_url' => 'getLegacyAuthMethodsUrl',
        'password_verify_url' => 'getPasswordVerifyUrl',
        'auth_success_redirect_url' => 'getAuthSuccessRedirectUrl',
        'password_reset_url' => 'getPasswordResetUrl',
        'allow_user_registration' => 'getAllowUserRegistration',
        'allow_ip_stickiness' => 'getAllowIpStickiness',
        'passkey_append_interval' => 'getPasskeyAppendInterval',
        'cli_secret' => 'getCliSecret',
        'fallback_language' => 'getFallbackLanguage',
        'auto_detect_language' => 'getAutoDetectLanguage',
        'integration_mode_hosted' => 'getIntegrationModeHosted',
        'integration_mode_api' => 'getIntegrationModeApi',
        'integration_mode_web_component' => 'getIntegrationModeWebComponent',
        'has_existing_users' => 'getHasExistingUsers',
        'application_url' => 'getApplicationUrl',
        'use_cli' => 'getUseCli',
        'created' => 'getCreated',
        'updated' => 'getUpdated'
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

    const PASSKEY_APPEND_INTERVAL__0D = '0d';
    const PASSKEY_APPEND_INTERVAL__1D = '1d';
    const PASSKEY_APPEND_INTERVAL__3D = '3d';
    const PASSKEY_APPEND_INTERVAL__1W = '1w';
    const PASSKEY_APPEND_INTERVAL__3W = '3w';
    const PASSKEY_APPEND_INTERVAL__1M = '1m';
    const PASSKEY_APPEND_INTERVAL__3M = '3m';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPasskeyAppendIntervalAllowableValues()
    {
        return [
            self::PASSKEY_APPEND_INTERVAL__0D,
            self::PASSKEY_APPEND_INTERVAL__1D,
            self::PASSKEY_APPEND_INTERVAL__3D,
            self::PASSKEY_APPEND_INTERVAL__1W,
            self::PASSKEY_APPEND_INTERVAL__3W,
            self::PASSKEY_APPEND_INTERVAL__1M,
            self::PASSKEY_APPEND_INTERVAL__3M,
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
        $this->container['project_id'] = $data['project_id'] ?? null;
        $this->container['external_name'] = $data['external_name'] ?? null;
        $this->container['email_from'] = $data['email_from'] ?? null;
        $this->container['sms_from'] = $data['sms_from'] ?? null;
        $this->container['external_application_protocol_version'] = $data['external_application_protocol_version'] ?? null;
        $this->container['webhook_url'] = $data['webhook_url'] ?? null;
        $this->container['webhook_username'] = $data['webhook_username'] ?? null;
        $this->container['webhook_password'] = $data['webhook_password'] ?? null;
        $this->container['webhook_test_invalid_username'] = $data['webhook_test_invalid_username'] ?? null;
        $this->container['webhook_test_valid_username'] = $data['webhook_test_valid_username'] ?? null;
        $this->container['webhook_test_valid_password'] = $data['webhook_test_valid_password'] ?? null;
        $this->container['external_application_username'] = $data['external_application_username'] ?? null;
        $this->container['external_application_password'] = $data['external_application_password'] ?? null;
        $this->container['legacy_auth_methods_url'] = $data['legacy_auth_methods_url'] ?? null;
        $this->container['password_verify_url'] = $data['password_verify_url'] ?? null;
        $this->container['auth_success_redirect_url'] = $data['auth_success_redirect_url'] ?? null;
        $this->container['password_reset_url'] = $data['password_reset_url'] ?? null;
        $this->container['allow_user_registration'] = $data['allow_user_registration'] ?? null;
        $this->container['allow_ip_stickiness'] = $data['allow_ip_stickiness'] ?? null;
        $this->container['passkey_append_interval'] = $data['passkey_append_interval'] ?? null;
        $this->container['cli_secret'] = $data['cli_secret'] ?? null;
        $this->container['fallback_language'] = $data['fallback_language'] ?? null;
        $this->container['auto_detect_language'] = $data['auto_detect_language'] ?? null;
        $this->container['integration_mode_hosted'] = $data['integration_mode_hosted'] ?? null;
        $this->container['integration_mode_api'] = $data['integration_mode_api'] ?? null;
        $this->container['integration_mode_web_component'] = $data['integration_mode_web_component'] ?? null;
        $this->container['has_existing_users'] = $data['has_existing_users'] ?? null;
        $this->container['application_url'] = $data['application_url'] ?? null;
        $this->container['use_cli'] = $data['use_cli'] ?? null;
        $this->container['created'] = $data['created'] ?? null;
        $this->container['updated'] = $data['updated'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['project_id'] === null) {
            $invalidProperties[] = "'project_id' can't be null";
        }
        if ($this->container['external_name'] === null) {
            $invalidProperties[] = "'external_name' can't be null";
        }
        if ($this->container['email_from'] === null) {
            $invalidProperties[] = "'email_from' can't be null";
        }
        if ($this->container['sms_from'] === null) {
            $invalidProperties[] = "'sms_from' can't be null";
        }
        $allowedValues = $this->getPasskeyAppendIntervalAllowableValues();
        if (!is_null($this->container['passkey_append_interval']) && !in_array($this->container['passkey_append_interval'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'passkey_append_interval', must be one of '%s'",
                $this->container['passkey_append_interval'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['fallback_language'] === null) {
            $invalidProperties[] = "'fallback_language' can't be null";
        }
        if ($this->container['auto_detect_language'] === null) {
            $invalidProperties[] = "'auto_detect_language' can't be null";
        }
        if ($this->container['integration_mode_hosted'] === null) {
            $invalidProperties[] = "'integration_mode_hosted' can't be null";
        }
        if ($this->container['integration_mode_api'] === null) {
            $invalidProperties[] = "'integration_mode_api' can't be null";
        }
        if ($this->container['integration_mode_web_component'] === null) {
            $invalidProperties[] = "'integration_mode_web_component' can't be null";
        }
        if ($this->container['has_existing_users'] === null) {
            $invalidProperties[] = "'has_existing_users' can't be null";
        }
        if ($this->container['application_url'] === null) {
            $invalidProperties[] = "'application_url' can't be null";
        }
        if ($this->container['use_cli'] === null) {
            $invalidProperties[] = "'use_cli' can't be null";
        }
        if ($this->container['created'] === null) {
            $invalidProperties[] = "'created' can't be null";
        }
        if ($this->container['updated'] === null) {
            $invalidProperties[] = "'updated' can't be null";
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
     * Gets project_id
     *
     * @return string
     */
    public function getProjectId()
    {
        return $this->container['project_id'];
    }

    /**
     * Sets project_id
     *
     * @param string $project_id ID of project
     *
     * @return self
     */
    public function setProjectId($project_id)
    {
        $this->container['project_id'] = $project_id;

        return $this;
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
     * Gets external_application_protocol_version
     *
     * @return string|null
     */
    public function getExternalApplicationProtocolVersion()
    {
        return $this->container['external_application_protocol_version'];
    }

    /**
     * Sets external_application_protocol_version
     *
     * @param string|null $external_application_protocol_version external_application_protocol_version
     *
     * @return self
     */
    public function setExternalApplicationProtocolVersion($external_application_protocol_version)
    {
        $this->container['external_application_protocol_version'] = $external_application_protocol_version;

        return $this;
    }

    /**
     * Gets webhook_url
     *
     * @return string|null
     */
    public function getWebhookUrl()
    {
        return $this->container['webhook_url'];
    }

    /**
     * Sets webhook_url
     *
     * @param string|null $webhook_url webhook_url
     *
     * @return self
     */
    public function setWebhookUrl($webhook_url)
    {
        $this->container['webhook_url'] = $webhook_url;

        return $this;
    }

    /**
     * Gets webhook_username
     *
     * @return string|null
     */
    public function getWebhookUsername()
    {
        return $this->container['webhook_username'];
    }

    /**
     * Sets webhook_username
     *
     * @param string|null $webhook_username webhook_username
     *
     * @return self
     */
    public function setWebhookUsername($webhook_username)
    {
        $this->container['webhook_username'] = $webhook_username;

        return $this;
    }

    /**
     * Gets webhook_password
     *
     * @return string|null
     */
    public function getWebhookPassword()
    {
        return $this->container['webhook_password'];
    }

    /**
     * Sets webhook_password
     *
     * @param string|null $webhook_password webhook_password
     *
     * @return self
     */
    public function setWebhookPassword($webhook_password)
    {
        $this->container['webhook_password'] = $webhook_password;

        return $this;
    }

    /**
     * Gets webhook_test_invalid_username
     *
     * @return string|null
     */
    public function getWebhookTestInvalidUsername()
    {
        return $this->container['webhook_test_invalid_username'];
    }

    /**
     * Sets webhook_test_invalid_username
     *
     * @param string|null $webhook_test_invalid_username webhook_test_invalid_username
     *
     * @return self
     */
    public function setWebhookTestInvalidUsername($webhook_test_invalid_username)
    {
        $this->container['webhook_test_invalid_username'] = $webhook_test_invalid_username;

        return $this;
    }

    /**
     * Gets webhook_test_valid_username
     *
     * @return string|null
     */
    public function getWebhookTestValidUsername()
    {
        return $this->container['webhook_test_valid_username'];
    }

    /**
     * Sets webhook_test_valid_username
     *
     * @param string|null $webhook_test_valid_username webhook_test_valid_username
     *
     * @return self
     */
    public function setWebhookTestValidUsername($webhook_test_valid_username)
    {
        $this->container['webhook_test_valid_username'] = $webhook_test_valid_username;

        return $this;
    }

    /**
     * Gets webhook_test_valid_password
     *
     * @return string|null
     */
    public function getWebhookTestValidPassword()
    {
        return $this->container['webhook_test_valid_password'];
    }

    /**
     * Sets webhook_test_valid_password
     *
     * @param string|null $webhook_test_valid_password webhook_test_valid_password
     *
     * @return self
     */
    public function setWebhookTestValidPassword($webhook_test_valid_password)
    {
        $this->container['webhook_test_valid_password'] = $webhook_test_valid_password;

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
     * Gets allow_ip_stickiness
     *
     * @return bool|null
     */
    public function getAllowIpStickiness()
    {
        return $this->container['allow_ip_stickiness'];
    }

    /**
     * Sets allow_ip_stickiness
     *
     * @param bool|null $allow_ip_stickiness allow_ip_stickiness
     *
     * @return self
     */
    public function setAllowIpStickiness($allow_ip_stickiness)
    {
        $this->container['allow_ip_stickiness'] = $allow_ip_stickiness;

        return $this;
    }

    /**
     * Gets passkey_append_interval
     *
     * @return string|null
     */
    public function getPasskeyAppendInterval()
    {
        return $this->container['passkey_append_interval'];
    }

    /**
     * Sets passkey_append_interval
     *
     * @param string|null $passkey_append_interval passkey_append_interval
     *
     * @return self
     */
    public function setPasskeyAppendInterval($passkey_append_interval)
    {
        $allowedValues = $this->getPasskeyAppendIntervalAllowableValues();
        if (!is_null($passkey_append_interval) && !in_array($passkey_append_interval, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'passkey_append_interval', must be one of '%s'",
                    $passkey_append_interval,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['passkey_append_interval'] = $passkey_append_interval;

        return $this;
    }

    /**
     * Gets cli_secret
     *
     * @return string|null
     */
    public function getCliSecret()
    {
        return $this->container['cli_secret'];
    }

    /**
     * Sets cli_secret
     *
     * @param string|null $cli_secret cli_secret
     *
     * @return self
     */
    public function setCliSecret($cli_secret)
    {
        $this->container['cli_secret'] = $cli_secret;

        return $this;
    }

    /**
     * Gets fallback_language
     *
     * @return string
     */
    public function getFallbackLanguage()
    {
        return $this->container['fallback_language'];
    }

    /**
     * Sets fallback_language
     *
     * @param string $fallback_language fallback_language
     *
     * @return self
     */
    public function setFallbackLanguage($fallback_language)
    {
        $this->container['fallback_language'] = $fallback_language;

        return $this;
    }

    /**
     * Gets auto_detect_language
     *
     * @return bool
     */
    public function getAutoDetectLanguage()
    {
        return $this->container['auto_detect_language'];
    }

    /**
     * Sets auto_detect_language
     *
     * @param bool $auto_detect_language auto_detect_language
     *
     * @return self
     */
    public function setAutoDetectLanguage($auto_detect_language)
    {
        $this->container['auto_detect_language'] = $auto_detect_language;

        return $this;
    }

    /**
     * Gets integration_mode_hosted
     *
     * @return bool
     */
    public function getIntegrationModeHosted()
    {
        return $this->container['integration_mode_hosted'];
    }

    /**
     * Sets integration_mode_hosted
     *
     * @param bool $integration_mode_hosted integration_mode_hosted
     *
     * @return self
     */
    public function setIntegrationModeHosted($integration_mode_hosted)
    {
        $this->container['integration_mode_hosted'] = $integration_mode_hosted;

        return $this;
    }

    /**
     * Gets integration_mode_api
     *
     * @return bool
     */
    public function getIntegrationModeApi()
    {
        return $this->container['integration_mode_api'];
    }

    /**
     * Sets integration_mode_api
     *
     * @param bool $integration_mode_api integration_mode_api
     *
     * @return self
     */
    public function setIntegrationModeApi($integration_mode_api)
    {
        $this->container['integration_mode_api'] = $integration_mode_api;

        return $this;
    }

    /**
     * Gets integration_mode_web_component
     *
     * @return bool
     */
    public function getIntegrationModeWebComponent()
    {
        return $this->container['integration_mode_web_component'];
    }

    /**
     * Sets integration_mode_web_component
     *
     * @param bool $integration_mode_web_component integration_mode_web_component
     *
     * @return self
     */
    public function setIntegrationModeWebComponent($integration_mode_web_component)
    {
        $this->container['integration_mode_web_component'] = $integration_mode_web_component;

        return $this;
    }

    /**
     * Gets has_existing_users
     *
     * @return bool
     */
    public function getHasExistingUsers()
    {
        return $this->container['has_existing_users'];
    }

    /**
     * Sets has_existing_users
     *
     * @param bool $has_existing_users has_existing_users
     *
     * @return self
     */
    public function setHasExistingUsers($has_existing_users)
    {
        $this->container['has_existing_users'] = $has_existing_users;

        return $this;
    }

    /**
     * Gets application_url
     *
     * @return string
     */
    public function getApplicationUrl()
    {
        return $this->container['application_url'];
    }

    /**
     * Sets application_url
     *
     * @param string $application_url application_url
     *
     * @return self
     */
    public function setApplicationUrl($application_url)
    {
        $this->container['application_url'] = $application_url;

        return $this;
    }

    /**
     * Gets use_cli
     *
     * @return bool
     */
    public function getUseCli()
    {
        return $this->container['use_cli'];
    }

    /**
     * Sets use_cli
     *
     * @param bool $use_cli use_cli
     *
     * @return self
     */
    public function setUseCli($use_cli)
    {
        $this->container['use_cli'] = $use_cli;

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
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->container['updated'];
    }

    /**
     * Sets updated
     *
     * @param string $updated Timestamp of when the entity was last updated in yyyy-MM-dd'T'HH:mm:ss format
     *
     * @return self
     */
    public function setUpdated($updated)
    {
        $this->container['updated'] = $updated;

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


