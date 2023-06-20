<?php
/**
 * EmailTemplateCreateReq
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
 * EmailTemplateCreateReq Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class EmailTemplateCreateReq implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'emailTemplateCreateReq';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'type' => 'string',
        'name' => 'string',
        'subject' => 'string',
        'action' => 'string',
        'plain_text_body' => 'string',
        'html_text_title' => 'string',
        'html_text_body' => 'string',
        'html_text_button' => 'string',
        'html_color_font' => 'string',
        'html_color_background_outer' => 'string',
        'html_color_background_inner' => 'string',
        'html_color_button' => 'string',
        'html_color_button_font' => 'string',
        'is_default' => 'bool',
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
        'type' => null,
        'name' => null,
        'subject' => null,
        'action' => null,
        'plain_text_body' => null,
        'html_text_title' => null,
        'html_text_body' => null,
        'html_text_button' => null,
        'html_color_font' => null,
        'html_color_background_outer' => null,
        'html_color_background_inner' => null,
        'html_color_button' => null,
        'html_color_button_font' => null,
        'is_default' => null,
        'request_id' => null,
        'client_info' => null
    ];

    /**
      * Array of nullable properties. Used for (de)serialization
      *
      * @var boolean[]
      */
    protected static array $openAPINullables = [
        'type' => false,
		'name' => false,
		'subject' => false,
		'action' => false,
		'plain_text_body' => false,
		'html_text_title' => false,
		'html_text_body' => false,
		'html_text_button' => false,
		'html_color_font' => false,
		'html_color_background_outer' => false,
		'html_color_background_inner' => false,
		'html_color_button' => false,
		'html_color_button_font' => false,
		'is_default' => false,
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
        'type' => 'type',
        'name' => 'name',
        'subject' => 'subject',
        'action' => 'action',
        'plain_text_body' => 'plainTextBody',
        'html_text_title' => 'htmlTextTitle',
        'html_text_body' => 'htmlTextBody',
        'html_text_button' => 'htmlTextButton',
        'html_color_font' => 'htmlColorFont',
        'html_color_background_outer' => 'htmlColorBackgroundOuter',
        'html_color_background_inner' => 'htmlColorBackgroundInner',
        'html_color_button' => 'htmlColorButton',
        'html_color_button_font' => 'htmlColorButtonFont',
        'is_default' => 'isDefault',
        'request_id' => 'requestID',
        'client_info' => 'clientInfo'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type' => 'setType',
        'name' => 'setName',
        'subject' => 'setSubject',
        'action' => 'setAction',
        'plain_text_body' => 'setPlainTextBody',
        'html_text_title' => 'setHtmlTextTitle',
        'html_text_body' => 'setHtmlTextBody',
        'html_text_button' => 'setHtmlTextButton',
        'html_color_font' => 'setHtmlColorFont',
        'html_color_background_outer' => 'setHtmlColorBackgroundOuter',
        'html_color_background_inner' => 'setHtmlColorBackgroundInner',
        'html_color_button' => 'setHtmlColorButton',
        'html_color_button_font' => 'setHtmlColorButtonFont',
        'is_default' => 'setIsDefault',
        'request_id' => 'setRequestId',
        'client_info' => 'setClientInfo'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type' => 'getType',
        'name' => 'getName',
        'subject' => 'getSubject',
        'action' => 'getAction',
        'plain_text_body' => 'getPlainTextBody',
        'html_text_title' => 'getHtmlTextTitle',
        'html_text_body' => 'getHtmlTextBody',
        'html_text_button' => 'getHtmlTextButton',
        'html_color_font' => 'getHtmlColorFont',
        'html_color_background_outer' => 'getHtmlColorBackgroundOuter',
        'html_color_background_inner' => 'getHtmlColorBackgroundInner',
        'html_color_button' => 'getHtmlColorButton',
        'html_color_button_font' => 'getHtmlColorButtonFont',
        'is_default' => 'getIsDefault',
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

    public const TYPE_EMAIL_LINK = 'email_link';
    public const TYPE_LOGIN_NOTIFICATION = 'login_notification';
    public const TYPE_PASSKEY_NOTIFICATION = 'passkey_notification';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_EMAIL_LINK,
            self::TYPE_LOGIN_NOTIFICATION,
            self::TYPE_PASSKEY_NOTIFICATION,
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
        $this->setIfExists('type', $data ?? [], null);
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('subject', $data ?? [], null);
        $this->setIfExists('action', $data ?? [], null);
        $this->setIfExists('plain_text_body', $data ?? [], null);
        $this->setIfExists('html_text_title', $data ?? [], null);
        $this->setIfExists('html_text_body', $data ?? [], null);
        $this->setIfExists('html_text_button', $data ?? [], null);
        $this->setIfExists('html_color_font', $data ?? [], null);
        $this->setIfExists('html_color_background_outer', $data ?? [], null);
        $this->setIfExists('html_color_background_inner', $data ?? [], null);
        $this->setIfExists('html_color_button', $data ?? [], null);
        $this->setIfExists('html_color_button_font', $data ?? [], null);
        $this->setIfExists('is_default', $data ?? [], null);
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

        if ($this->container['type'] === null) {
            $invalidProperties[] = "'type' can't be null";
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!is_null($this->container['type']) && !in_array($this->container['type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'type', must be one of '%s'",
                $this->container['type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['subject'] === null) {
            $invalidProperties[] = "'subject' can't be null";
        }
        if ($this->container['plain_text_body'] === null) {
            $invalidProperties[] = "'plain_text_body' can't be null";
        }
        if ($this->container['html_text_title'] === null) {
            $invalidProperties[] = "'html_text_title' can't be null";
        }
        if ($this->container['html_text_body'] === null) {
            $invalidProperties[] = "'html_text_body' can't be null";
        }
        if ($this->container['html_text_button'] === null) {
            $invalidProperties[] = "'html_text_button' can't be null";
        }
        if ($this->container['html_color_font'] === null) {
            $invalidProperties[] = "'html_color_font' can't be null";
        }
        if ($this->container['html_color_background_outer'] === null) {
            $invalidProperties[] = "'html_color_background_outer' can't be null";
        }
        if ($this->container['html_color_background_inner'] === null) {
            $invalidProperties[] = "'html_color_background_inner' can't be null";
        }
        if ($this->container['html_color_button'] === null) {
            $invalidProperties[] = "'html_color_button' can't be null";
        }
        if ($this->container['html_color_button_font'] === null) {
            $invalidProperties[] = "'html_color_button_font' can't be null";
        }
        if ($this->container['is_default'] === null) {
            $invalidProperties[] = "'is_default' can't be null";
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
     * Gets type
     *
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     *
     * @param string $type type
     *
     * @return self
     */
    public function setType($type)
    {
        if (is_null($type)) {
            throw new \InvalidArgumentException('non-nullable type cannot be null');
        }
        $allowedValues = $this->getTypeAllowableValues();
        if (!in_array($type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'type', must be one of '%s'",
                    $type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['type'] = $type;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name name
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->container['subject'];
    }

    /**
     * Sets subject
     *
     * @param string $subject subject
     *
     * @return self
     */
    public function setSubject($subject)
    {
        if (is_null($subject)) {
            throw new \InvalidArgumentException('non-nullable subject cannot be null');
        }
        $this->container['subject'] = $subject;

        return $this;
    }

    /**
     * Gets action
     *
     * @return string|null
     */
    public function getAction()
    {
        return $this->container['action'];
    }

    /**
     * Sets action
     *
     * @param string|null $action action
     *
     * @return self
     */
    public function setAction($action)
    {
        if (is_null($action)) {
            throw new \InvalidArgumentException('non-nullable action cannot be null');
        }
        $this->container['action'] = $action;

        return $this;
    }

    /**
     * Gets plain_text_body
     *
     * @return string
     */
    public function getPlainTextBody()
    {
        return $this->container['plain_text_body'];
    }

    /**
     * Sets plain_text_body
     *
     * @param string $plain_text_body plain_text_body
     *
     * @return self
     */
    public function setPlainTextBody($plain_text_body)
    {
        if (is_null($plain_text_body)) {
            throw new \InvalidArgumentException('non-nullable plain_text_body cannot be null');
        }
        $this->container['plain_text_body'] = $plain_text_body;

        return $this;
    }

    /**
     * Gets html_text_title
     *
     * @return string
     */
    public function getHtmlTextTitle()
    {
        return $this->container['html_text_title'];
    }

    /**
     * Sets html_text_title
     *
     * @param string $html_text_title html_text_title
     *
     * @return self
     */
    public function setHtmlTextTitle($html_text_title)
    {
        if (is_null($html_text_title)) {
            throw new \InvalidArgumentException('non-nullable html_text_title cannot be null');
        }
        $this->container['html_text_title'] = $html_text_title;

        return $this;
    }

    /**
     * Gets html_text_body
     *
     * @return string
     */
    public function getHtmlTextBody()
    {
        return $this->container['html_text_body'];
    }

    /**
     * Sets html_text_body
     *
     * @param string $html_text_body html_text_body
     *
     * @return self
     */
    public function setHtmlTextBody($html_text_body)
    {
        if (is_null($html_text_body)) {
            throw new \InvalidArgumentException('non-nullable html_text_body cannot be null');
        }
        $this->container['html_text_body'] = $html_text_body;

        return $this;
    }

    /**
     * Gets html_text_button
     *
     * @return string
     */
    public function getHtmlTextButton()
    {
        return $this->container['html_text_button'];
    }

    /**
     * Sets html_text_button
     *
     * @param string $html_text_button html_text_button
     *
     * @return self
     */
    public function setHtmlTextButton($html_text_button)
    {
        if (is_null($html_text_button)) {
            throw new \InvalidArgumentException('non-nullable html_text_button cannot be null');
        }
        $this->container['html_text_button'] = $html_text_button;

        return $this;
    }

    /**
     * Gets html_color_font
     *
     * @return string
     */
    public function getHtmlColorFont()
    {
        return $this->container['html_color_font'];
    }

    /**
     * Sets html_color_font
     *
     * @param string $html_color_font html_color_font
     *
     * @return self
     */
    public function setHtmlColorFont($html_color_font)
    {
        if (is_null($html_color_font)) {
            throw new \InvalidArgumentException('non-nullable html_color_font cannot be null');
        }
        $this->container['html_color_font'] = $html_color_font;

        return $this;
    }

    /**
     * Gets html_color_background_outer
     *
     * @return string
     */
    public function getHtmlColorBackgroundOuter()
    {
        return $this->container['html_color_background_outer'];
    }

    /**
     * Sets html_color_background_outer
     *
     * @param string $html_color_background_outer html_color_background_outer
     *
     * @return self
     */
    public function setHtmlColorBackgroundOuter($html_color_background_outer)
    {
        if (is_null($html_color_background_outer)) {
            throw new \InvalidArgumentException('non-nullable html_color_background_outer cannot be null');
        }
        $this->container['html_color_background_outer'] = $html_color_background_outer;

        return $this;
    }

    /**
     * Gets html_color_background_inner
     *
     * @return string
     */
    public function getHtmlColorBackgroundInner()
    {
        return $this->container['html_color_background_inner'];
    }

    /**
     * Sets html_color_background_inner
     *
     * @param string $html_color_background_inner html_color_background_inner
     *
     * @return self
     */
    public function setHtmlColorBackgroundInner($html_color_background_inner)
    {
        if (is_null($html_color_background_inner)) {
            throw new \InvalidArgumentException('non-nullable html_color_background_inner cannot be null');
        }
        $this->container['html_color_background_inner'] = $html_color_background_inner;

        return $this;
    }

    /**
     * Gets html_color_button
     *
     * @return string
     */
    public function getHtmlColorButton()
    {
        return $this->container['html_color_button'];
    }

    /**
     * Sets html_color_button
     *
     * @param string $html_color_button html_color_button
     *
     * @return self
     */
    public function setHtmlColorButton($html_color_button)
    {
        if (is_null($html_color_button)) {
            throw new \InvalidArgumentException('non-nullable html_color_button cannot be null');
        }
        $this->container['html_color_button'] = $html_color_button;

        return $this;
    }

    /**
     * Gets html_color_button_font
     *
     * @return string
     */
    public function getHtmlColorButtonFont()
    {
        return $this->container['html_color_button_font'];
    }

    /**
     * Sets html_color_button_font
     *
     * @param string $html_color_button_font html_color_button_font
     *
     * @return self
     */
    public function setHtmlColorButtonFont($html_color_button_font)
    {
        if (is_null($html_color_button_font)) {
            throw new \InvalidArgumentException('non-nullable html_color_button_font cannot be null');
        }
        $this->container['html_color_button_font'] = $html_color_button_font;

        return $this;
    }

    /**
     * Gets is_default
     *
     * @return bool
     */
    public function getIsDefault()
    {
        return $this->container['is_default'];
    }

    /**
     * Sets is_default
     *
     * @param bool $is_default is_default
     *
     * @return self
     */
    public function setIsDefault($is_default)
    {
        if (is_null($is_default)) {
            throw new \InvalidArgumentException('non-nullable is_default cannot be null');
        }
        $this->container['is_default'] = $is_default;

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


