<?php
/**
 * UserApi
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

namespace Corbado\Generated\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Corbado\Generated\ApiException;
use Corbado\Generated\Configuration;
use Corbado\Generated\HeaderSelector;
use Corbado\Generated\ObjectSerializer;

/**
 * UserApi Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class UserApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'userAuthLogList' => [
            'application/json',
        ],
        'userCreate' => [
            'application/json',
        ],
        'userCustomLoginIdentifierCreate' => [
            'application/json',
        ],
        'userCustomLoginIdentifierDelete' => [
            'application/json',
        ],
        'userCustomLoginIdentifierGet' => [
            'application/json',
        ],
        'userDelete' => [
            'application/json',
        ],
        'userDeviceList' => [
            'application/json',
        ],
        'userEmailCreate' => [
            'application/json',
        ],
        'userEmailDelete' => [
            'application/json',
        ],
        'userEmailGet' => [
            'application/json',
        ],
        'userGet' => [
            'application/json',
        ],
        'userList' => [
            'application/json',
        ],
        'userPhoneNumberCreate' => [
            'application/json',
        ],
        'userPhoneNumberDelete' => [
            'application/json',
        ],
        'userPhoneNumberGet' => [
            'application/json',
        ],
        'userStatsList' => [
            'application/json',
        ],
        'userUpdate' => [
            'application/json',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation userAuthLogList
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userAuthLogList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserAuthLogListRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userAuthLogList($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userAuthLogList'][0])
    {
        list($response) = $this->userAuthLogListWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);
        return $response;
    }

    /**
     * Operation userAuthLogListWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userAuthLogList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserAuthLogListRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userAuthLogListWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userAuthLogList'][0])
    {
        $request = $this->userAuthLogListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserAuthLogListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserAuthLogListRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserAuthLogListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserAuthLogListRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserAuthLogListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userAuthLogListAsync
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userAuthLogList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userAuthLogListAsync($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userAuthLogList'][0])
    {
        return $this->userAuthLogListAsyncWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userAuthLogListAsyncWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userAuthLogList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userAuthLogListAsyncWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userAuthLogList'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserAuthLogListRsp';
        $request = $this->userAuthLogListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userAuthLogList'
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userAuthLogList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userAuthLogListRequest($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userAuthLogList'][0])
    {








        $resourcePath = '/v1/userauthlogs';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sort,
            'sort', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter,
            'filter[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page_size,
            'pageSize', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userCreate
     *
     * @param  \Corbado\Generated\Model\UserCreateReq $user_create_req user_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserCreateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userCreate($user_create_req, string $contentType = self::contentTypes['userCreate'][0])
    {
        list($response) = $this->userCreateWithHttpInfo($user_create_req, $contentType);
        return $response;
    }

    /**
     * Operation userCreateWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\UserCreateReq $user_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserCreateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userCreateWithHttpInfo($user_create_req, string $contentType = self::contentTypes['userCreate'][0])
    {
        $request = $this->userCreateRequest($user_create_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserCreateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserCreateRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserCreateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserCreateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserCreateRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userCreateAsync
     *
     * @param  \Corbado\Generated\Model\UserCreateReq $user_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCreateAsync($user_create_req, string $contentType = self::contentTypes['userCreate'][0])
    {
        return $this->userCreateAsyncWithHttpInfo($user_create_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userCreateAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\UserCreateReq $user_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCreateAsyncWithHttpInfo($user_create_req, string $contentType = self::contentTypes['userCreate'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserCreateRsp';
        $request = $this->userCreateRequest($user_create_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userCreate'
     *
     * @param  \Corbado\Generated\Model\UserCreateReq $user_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userCreateRequest($user_create_req, string $contentType = self::contentTypes['userCreate'][0])
    {

        // verify the required parameter 'user_create_req' is set
        if ($user_create_req === null || (is_array($user_create_req) && count($user_create_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_create_req when calling userCreate'
            );
        }


        $resourcePath = '/v1/users';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_create_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_create_req));
            } else {
                $httpBody = $user_create_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userCustomLoginIdentifierCreate
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierCreateReq $user_custom_login_identifier_create_req user_custom_login_identifier_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userCustomLoginIdentifierCreate($user_id, $user_custom_login_identifier_create_req, string $contentType = self::contentTypes['userCustomLoginIdentifierCreate'][0])
    {
        list($response) = $this->userCustomLoginIdentifierCreateWithHttpInfo($user_id, $user_custom_login_identifier_create_req, $contentType);
        return $response;
    }

    /**
     * Operation userCustomLoginIdentifierCreateWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierCreateReq $user_custom_login_identifier_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userCustomLoginIdentifierCreateWithHttpInfo($user_id, $user_custom_login_identifier_create_req, string $contentType = self::contentTypes['userCustomLoginIdentifierCreate'][0])
    {
        $request = $this->userCustomLoginIdentifierCreateRequest($user_id, $user_custom_login_identifier_create_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userCustomLoginIdentifierCreateAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierCreateReq $user_custom_login_identifier_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCustomLoginIdentifierCreateAsync($user_id, $user_custom_login_identifier_create_req, string $contentType = self::contentTypes['userCustomLoginIdentifierCreate'][0])
    {
        return $this->userCustomLoginIdentifierCreateAsyncWithHttpInfo($user_id, $user_custom_login_identifier_create_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userCustomLoginIdentifierCreateAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierCreateReq $user_custom_login_identifier_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCustomLoginIdentifierCreateAsyncWithHttpInfo($user_id, $user_custom_login_identifier_create_req, string $contentType = self::contentTypes['userCustomLoginIdentifierCreate'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserCustomLoginIdentifierCreateRsp';
        $request = $this->userCustomLoginIdentifierCreateRequest($user_id, $user_custom_login_identifier_create_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userCustomLoginIdentifierCreate'
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierCreateReq $user_custom_login_identifier_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userCustomLoginIdentifierCreateRequest($user_id, $user_custom_login_identifier_create_req, string $contentType = self::contentTypes['userCustomLoginIdentifierCreate'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userCustomLoginIdentifierCreate'
            );
        }

        // verify the required parameter 'user_custom_login_identifier_create_req' is set
        if ($user_custom_login_identifier_create_req === null || (is_array($user_custom_login_identifier_create_req) && count($user_custom_login_identifier_create_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_custom_login_identifier_create_req when calling userCustomLoginIdentifierCreate'
            );
        }


        $resourcePath = '/v1/users/{userID}/customLoginIdentifiers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_custom_login_identifier_create_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_custom_login_identifier_create_req));
            } else {
                $httpBody = $user_custom_login_identifier_create_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userCustomLoginIdentifierDelete
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierDeleteReq $user_custom_login_identifier_delete_req user_custom_login_identifier_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userCustomLoginIdentifierDelete($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, string $contentType = self::contentTypes['userCustomLoginIdentifierDelete'][0])
    {
        list($response) = $this->userCustomLoginIdentifierDeleteWithHttpInfo($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, $contentType);
        return $response;
    }

    /**
     * Operation userCustomLoginIdentifierDeleteWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierDeleteReq $user_custom_login_identifier_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userCustomLoginIdentifierDeleteWithHttpInfo($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, string $contentType = self::contentTypes['userCustomLoginIdentifierDelete'][0])
    {
        $request = $this->userCustomLoginIdentifierDeleteRequest($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\GenericRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\GenericRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\GenericRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\GenericRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\GenericRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userCustomLoginIdentifierDeleteAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierDeleteReq $user_custom_login_identifier_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCustomLoginIdentifierDeleteAsync($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, string $contentType = self::contentTypes['userCustomLoginIdentifierDelete'][0])
    {
        return $this->userCustomLoginIdentifierDeleteAsyncWithHttpInfo($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userCustomLoginIdentifierDeleteAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierDeleteReq $user_custom_login_identifier_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCustomLoginIdentifierDeleteAsyncWithHttpInfo($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, string $contentType = self::contentTypes['userCustomLoginIdentifierDelete'][0])
    {
        $returnType = '\Corbado\Generated\Model\GenericRsp';
        $request = $this->userCustomLoginIdentifierDeleteRequest($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userCustomLoginIdentifierDelete'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  \Corbado\Generated\Model\UserCustomLoginIdentifierDeleteReq $user_custom_login_identifier_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userCustomLoginIdentifierDeleteRequest($user_id, $custom_login_identifier_id, $user_custom_login_identifier_delete_req, string $contentType = self::contentTypes['userCustomLoginIdentifierDelete'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userCustomLoginIdentifierDelete'
            );
        }

        // verify the required parameter 'custom_login_identifier_id' is set
        if ($custom_login_identifier_id === null || (is_array($custom_login_identifier_id) && count($custom_login_identifier_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $custom_login_identifier_id when calling userCustomLoginIdentifierDelete'
            );
        }

        // verify the required parameter 'user_custom_login_identifier_delete_req' is set
        if ($user_custom_login_identifier_delete_req === null || (is_array($user_custom_login_identifier_delete_req) && count($user_custom_login_identifier_delete_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_custom_login_identifier_delete_req when calling userCustomLoginIdentifierDelete'
            );
        }


        $resourcePath = '/v1/users/{userID}/customLoginIdentifiers/{customLoginIdentifierID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($custom_login_identifier_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customLoginIdentifierID' . '}',
                ObjectSerializer::toPathValue($custom_login_identifier_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_custom_login_identifier_delete_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_custom_login_identifier_delete_req));
            } else {
                $httpBody = $user_custom_login_identifier_delete_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userCustomLoginIdentifierGet
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userCustomLoginIdentifierGet($user_id, $custom_login_identifier_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userCustomLoginIdentifierGet'][0])
    {
        list($response) = $this->userCustomLoginIdentifierGetWithHttpInfo($user_id, $custom_login_identifier_id, $remote_address, $user_agent, $contentType);
        return $response;
    }

    /**
     * Operation userCustomLoginIdentifierGetWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userCustomLoginIdentifierGetWithHttpInfo($user_id, $custom_login_identifier_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userCustomLoginIdentifierGet'][0])
    {
        $request = $this->userCustomLoginIdentifierGetRequest($user_id, $custom_login_identifier_id, $remote_address, $user_agent, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userCustomLoginIdentifierGetAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCustomLoginIdentifierGetAsync($user_id, $custom_login_identifier_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userCustomLoginIdentifierGet'][0])
    {
        return $this->userCustomLoginIdentifierGetAsyncWithHttpInfo($user_id, $custom_login_identifier_id, $remote_address, $user_agent, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userCustomLoginIdentifierGetAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userCustomLoginIdentifierGetAsyncWithHttpInfo($user_id, $custom_login_identifier_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userCustomLoginIdentifierGet'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserCustomLoginIdentifierGetRsp';
        $request = $this->userCustomLoginIdentifierGetRequest($user_id, $custom_login_identifier_id, $remote_address, $user_agent, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userCustomLoginIdentifierGet'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $custom_login_identifier_id ID of custom login identifier (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userCustomLoginIdentifierGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userCustomLoginIdentifierGetRequest($user_id, $custom_login_identifier_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userCustomLoginIdentifierGet'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userCustomLoginIdentifierGet'
            );
        }

        // verify the required parameter 'custom_login_identifier_id' is set
        if ($custom_login_identifier_id === null || (is_array($custom_login_identifier_id) && count($custom_login_identifier_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $custom_login_identifier_id when calling userCustomLoginIdentifierGet'
            );
        }




        $resourcePath = '/v1/users/{userID}/customLoginIdentifiers/{customLoginIdentifierID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($custom_login_identifier_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customLoginIdentifierID' . '}',
                ObjectSerializer::toPathValue($custom_login_identifier_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userDelete
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserDeleteReq $user_delete_req user_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userDelete($user_id, $user_delete_req, string $contentType = self::contentTypes['userDelete'][0])
    {
        list($response) = $this->userDeleteWithHttpInfo($user_id, $user_delete_req, $contentType);
        return $response;
    }

    /**
     * Operation userDeleteWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserDeleteReq $user_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userDeleteWithHttpInfo($user_id, $user_delete_req, string $contentType = self::contentTypes['userDelete'][0])
    {
        $request = $this->userDeleteRequest($user_id, $user_delete_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\GenericRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\GenericRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\GenericRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\GenericRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\GenericRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userDeleteAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserDeleteReq $user_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userDeleteAsync($user_id, $user_delete_req, string $contentType = self::contentTypes['userDelete'][0])
    {
        return $this->userDeleteAsyncWithHttpInfo($user_id, $user_delete_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userDeleteAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserDeleteReq $user_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userDeleteAsyncWithHttpInfo($user_id, $user_delete_req, string $contentType = self::contentTypes['userDelete'][0])
    {
        $returnType = '\Corbado\Generated\Model\GenericRsp';
        $request = $this->userDeleteRequest($user_id, $user_delete_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userDelete'
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserDeleteReq $user_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userDeleteRequest($user_id, $user_delete_req, string $contentType = self::contentTypes['userDelete'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userDelete'
            );
        }

        // verify the required parameter 'user_delete_req' is set
        if ($user_delete_req === null || (is_array($user_delete_req) && count($user_delete_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_delete_req when calling userDelete'
            );
        }


        $resourcePath = '/v1/users/{userID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_delete_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_delete_req));
            } else {
                $httpBody = $user_delete_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userDeviceList
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDeviceList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserDeviceListRsp
     */
    public function userDeviceList($user_id, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userDeviceList'][0])
    {
        list($response) = $this->userDeviceListWithHttpInfo($user_id, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);
        return $response;
    }

    /**
     * Operation userDeviceListWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDeviceList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserDeviceListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userDeviceListWithHttpInfo($user_id, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userDeviceList'][0])
    {
        $request = $this->userDeviceListRequest($user_id, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserDeviceListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserDeviceListRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserDeviceListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserDeviceListRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserDeviceListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userDeviceListAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDeviceList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userDeviceListAsync($user_id, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userDeviceList'][0])
    {
        return $this->userDeviceListAsyncWithHttpInfo($user_id, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userDeviceListAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDeviceList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userDeviceListAsyncWithHttpInfo($user_id, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userDeviceList'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserDeviceListRsp';
        $request = $this->userDeviceListRequest($user_id, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userDeviceList'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userDeviceList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userDeviceListRequest($user_id, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userDeviceList'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userDeviceList'
            );
        }








        $resourcePath = '/v1/users/{userID}/devices';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sort,
            'sort', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter,
            'filter[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page_size,
            'pageSize', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userEmailCreate
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserEmailCreateReq $user_email_create_req user_email_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserEmailCreateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userEmailCreate($user_id, $user_email_create_req, string $contentType = self::contentTypes['userEmailCreate'][0])
    {
        list($response) = $this->userEmailCreateWithHttpInfo($user_id, $user_email_create_req, $contentType);
        return $response;
    }

    /**
     * Operation userEmailCreateWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserEmailCreateReq $user_email_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserEmailCreateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userEmailCreateWithHttpInfo($user_id, $user_email_create_req, string $contentType = self::contentTypes['userEmailCreate'][0])
    {
        $request = $this->userEmailCreateRequest($user_id, $user_email_create_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserEmailCreateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserEmailCreateRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserEmailCreateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserEmailCreateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserEmailCreateRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userEmailCreateAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserEmailCreateReq $user_email_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userEmailCreateAsync($user_id, $user_email_create_req, string $contentType = self::contentTypes['userEmailCreate'][0])
    {
        return $this->userEmailCreateAsyncWithHttpInfo($user_id, $user_email_create_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userEmailCreateAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserEmailCreateReq $user_email_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userEmailCreateAsyncWithHttpInfo($user_id, $user_email_create_req, string $contentType = self::contentTypes['userEmailCreate'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserEmailCreateRsp';
        $request = $this->userEmailCreateRequest($user_id, $user_email_create_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userEmailCreate'
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserEmailCreateReq $user_email_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userEmailCreateRequest($user_id, $user_email_create_req, string $contentType = self::contentTypes['userEmailCreate'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userEmailCreate'
            );
        }

        // verify the required parameter 'user_email_create_req' is set
        if ($user_email_create_req === null || (is_array($user_email_create_req) && count($user_email_create_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_email_create_req when calling userEmailCreate'
            );
        }


        $resourcePath = '/v1/users/{userID}/emails';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_email_create_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_email_create_req));
            } else {
                $httpBody = $user_email_create_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userEmailDelete
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  \Corbado\Generated\Model\UserEmailDeleteReq $user_email_delete_req user_email_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userEmailDelete($user_id, $email_id, $user_email_delete_req, string $contentType = self::contentTypes['userEmailDelete'][0])
    {
        list($response) = $this->userEmailDeleteWithHttpInfo($user_id, $email_id, $user_email_delete_req, $contentType);
        return $response;
    }

    /**
     * Operation userEmailDeleteWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  \Corbado\Generated\Model\UserEmailDeleteReq $user_email_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userEmailDeleteWithHttpInfo($user_id, $email_id, $user_email_delete_req, string $contentType = self::contentTypes['userEmailDelete'][0])
    {
        $request = $this->userEmailDeleteRequest($user_id, $email_id, $user_email_delete_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\GenericRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\GenericRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\GenericRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\GenericRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\GenericRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userEmailDeleteAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  \Corbado\Generated\Model\UserEmailDeleteReq $user_email_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userEmailDeleteAsync($user_id, $email_id, $user_email_delete_req, string $contentType = self::contentTypes['userEmailDelete'][0])
    {
        return $this->userEmailDeleteAsyncWithHttpInfo($user_id, $email_id, $user_email_delete_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userEmailDeleteAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  \Corbado\Generated\Model\UserEmailDeleteReq $user_email_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userEmailDeleteAsyncWithHttpInfo($user_id, $email_id, $user_email_delete_req, string $contentType = self::contentTypes['userEmailDelete'][0])
    {
        $returnType = '\Corbado\Generated\Model\GenericRsp';
        $request = $this->userEmailDeleteRequest($user_id, $email_id, $user_email_delete_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userEmailDelete'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  \Corbado\Generated\Model\UserEmailDeleteReq $user_email_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userEmailDeleteRequest($user_id, $email_id, $user_email_delete_req, string $contentType = self::contentTypes['userEmailDelete'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userEmailDelete'
            );
        }

        // verify the required parameter 'email_id' is set
        if ($email_id === null || (is_array($email_id) && count($email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $email_id when calling userEmailDelete'
            );
        }

        // verify the required parameter 'user_email_delete_req' is set
        if ($user_email_delete_req === null || (is_array($user_email_delete_req) && count($user_email_delete_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_email_delete_req when calling userEmailDelete'
            );
        }


        $resourcePath = '/v1/users/{userID}/emails/{emailID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'emailID' . '}',
                ObjectSerializer::toPathValue($email_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_email_delete_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_email_delete_req));
            } else {
                $httpBody = $user_email_delete_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userEmailGet
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserEmailGetRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userEmailGet($user_id, $email_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userEmailGet'][0])
    {
        list($response) = $this->userEmailGetWithHttpInfo($user_id, $email_id, $remote_address, $user_agent, $contentType);
        return $response;
    }

    /**
     * Operation userEmailGetWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserEmailGetRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userEmailGetWithHttpInfo($user_id, $email_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userEmailGet'][0])
    {
        $request = $this->userEmailGetRequest($user_id, $email_id, $remote_address, $user_agent, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserEmailGetRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserEmailGetRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserEmailGetRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserEmailGetRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserEmailGetRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userEmailGetAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userEmailGetAsync($user_id, $email_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userEmailGet'][0])
    {
        return $this->userEmailGetAsyncWithHttpInfo($user_id, $email_id, $remote_address, $user_agent, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userEmailGetAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userEmailGetAsyncWithHttpInfo($user_id, $email_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userEmailGet'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserEmailGetRsp';
        $request = $this->userEmailGetRequest($user_id, $email_id, $remote_address, $user_agent, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userEmailGet'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $email_id ID of email (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userEmailGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userEmailGetRequest($user_id, $email_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userEmailGet'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userEmailGet'
            );
        }

        // verify the required parameter 'email_id' is set
        if ($email_id === null || (is_array($email_id) && count($email_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $email_id when calling userEmailGet'
            );
        }




        $resourcePath = '/v1/users/{userID}/emails/{emailID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($email_id !== null) {
            $resourcePath = str_replace(
                '{' . 'emailID' . '}',
                ObjectSerializer::toPathValue($email_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userGet
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserGetRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userGet($user_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userGet'][0])
    {
        list($response) = $this->userGetWithHttpInfo($user_id, $remote_address, $user_agent, $contentType);
        return $response;
    }

    /**
     * Operation userGetWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserGetRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userGetWithHttpInfo($user_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userGet'][0])
    {
        $request = $this->userGetRequest($user_id, $remote_address, $user_agent, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserGetRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserGetRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserGetRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserGetRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserGetRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userGetAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userGetAsync($user_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userGet'][0])
    {
        return $this->userGetAsyncWithHttpInfo($user_id, $remote_address, $user_agent, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userGetAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userGetAsyncWithHttpInfo($user_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userGet'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserGetRsp';
        $request = $this->userGetRequest($user_id, $remote_address, $user_agent, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userGet'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userGetRequest($user_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userGet'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userGet'
            );
        }




        $resourcePath = '/v1/users/{userID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userList
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserListRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userList($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userList'][0])
    {
        list($response) = $this->userListWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);
        return $response;
    }

    /**
     * Operation userListWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserListRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userListWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userList'][0])
    {
        $request = $this->userListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserListRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserListRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userListAsync
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userListAsync($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userList'][0])
    {
        return $this->userListAsyncWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userListAsyncWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userListAsyncWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userList'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserListRsp';
        $request = $this->userListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userList'
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userListRequest($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userList'][0])
    {








        $resourcePath = '/v1/users';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sort,
            'sort', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter,
            'filter[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page_size,
            'pageSize', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userPhoneNumberCreate
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberCreateReq $user_phone_number_create_req user_phone_number_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserPhoneNumberCreateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userPhoneNumberCreate($user_id, $user_phone_number_create_req, string $contentType = self::contentTypes['userPhoneNumberCreate'][0])
    {
        list($response) = $this->userPhoneNumberCreateWithHttpInfo($user_id, $user_phone_number_create_req, $contentType);
        return $response;
    }

    /**
     * Operation userPhoneNumberCreateWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberCreateReq $user_phone_number_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberCreate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserPhoneNumberCreateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userPhoneNumberCreateWithHttpInfo($user_id, $user_phone_number_create_req, string $contentType = self::contentTypes['userPhoneNumberCreate'][0])
    {
        $request = $this->userPhoneNumberCreateRequest($user_id, $user_phone_number_create_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserPhoneNumberCreateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserPhoneNumberCreateRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserPhoneNumberCreateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserPhoneNumberCreateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserPhoneNumberCreateRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userPhoneNumberCreateAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberCreateReq $user_phone_number_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userPhoneNumberCreateAsync($user_id, $user_phone_number_create_req, string $contentType = self::contentTypes['userPhoneNumberCreate'][0])
    {
        return $this->userPhoneNumberCreateAsyncWithHttpInfo($user_id, $user_phone_number_create_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userPhoneNumberCreateAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberCreateReq $user_phone_number_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userPhoneNumberCreateAsyncWithHttpInfo($user_id, $user_phone_number_create_req, string $contentType = self::contentTypes['userPhoneNumberCreate'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserPhoneNumberCreateRsp';
        $request = $this->userPhoneNumberCreateRequest($user_id, $user_phone_number_create_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userPhoneNumberCreate'
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberCreateReq $user_phone_number_create_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userPhoneNumberCreateRequest($user_id, $user_phone_number_create_req, string $contentType = self::contentTypes['userPhoneNumberCreate'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userPhoneNumberCreate'
            );
        }

        // verify the required parameter 'user_phone_number_create_req' is set
        if ($user_phone_number_create_req === null || (is_array($user_phone_number_create_req) && count($user_phone_number_create_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_phone_number_create_req when calling userPhoneNumberCreate'
            );
        }


        $resourcePath = '/v1/users/{userID}/phoneNumbers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_phone_number_create_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_phone_number_create_req));
            } else {
                $httpBody = $user_phone_number_create_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userPhoneNumberDelete
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberDeleteReq $user_phone_number_delete_req user_phone_number_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userPhoneNumberDelete($user_id, $phone_number_id, $user_phone_number_delete_req, string $contentType = self::contentTypes['userPhoneNumberDelete'][0])
    {
        list($response) = $this->userPhoneNumberDeleteWithHttpInfo($user_id, $phone_number_id, $user_phone_number_delete_req, $contentType);
        return $response;
    }

    /**
     * Operation userPhoneNumberDeleteWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberDeleteReq $user_phone_number_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberDelete'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userPhoneNumberDeleteWithHttpInfo($user_id, $phone_number_id, $user_phone_number_delete_req, string $contentType = self::contentTypes['userPhoneNumberDelete'][0])
    {
        $request = $this->userPhoneNumberDeleteRequest($user_id, $phone_number_id, $user_phone_number_delete_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\GenericRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\GenericRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\GenericRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\GenericRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\GenericRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userPhoneNumberDeleteAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberDeleteReq $user_phone_number_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userPhoneNumberDeleteAsync($user_id, $phone_number_id, $user_phone_number_delete_req, string $contentType = self::contentTypes['userPhoneNumberDelete'][0])
    {
        return $this->userPhoneNumberDeleteAsyncWithHttpInfo($user_id, $phone_number_id, $user_phone_number_delete_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userPhoneNumberDeleteAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberDeleteReq $user_phone_number_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userPhoneNumberDeleteAsyncWithHttpInfo($user_id, $phone_number_id, $user_phone_number_delete_req, string $contentType = self::contentTypes['userPhoneNumberDelete'][0])
    {
        $returnType = '\Corbado\Generated\Model\GenericRsp';
        $request = $this->userPhoneNumberDeleteRequest($user_id, $phone_number_id, $user_phone_number_delete_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userPhoneNumberDelete'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  \Corbado\Generated\Model\UserPhoneNumberDeleteReq $user_phone_number_delete_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberDelete'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userPhoneNumberDeleteRequest($user_id, $phone_number_id, $user_phone_number_delete_req, string $contentType = self::contentTypes['userPhoneNumberDelete'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userPhoneNumberDelete'
            );
        }

        // verify the required parameter 'phone_number_id' is set
        if ($phone_number_id === null || (is_array($phone_number_id) && count($phone_number_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $phone_number_id when calling userPhoneNumberDelete'
            );
        }

        // verify the required parameter 'user_phone_number_delete_req' is set
        if ($user_phone_number_delete_req === null || (is_array($user_phone_number_delete_req) && count($user_phone_number_delete_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_phone_number_delete_req when calling userPhoneNumberDelete'
            );
        }


        $resourcePath = '/v1/users/{userID}/phoneNumbers/{phoneNumberID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($phone_number_id !== null) {
            $resourcePath = str_replace(
                '{' . 'phoneNumberID' . '}',
                ObjectSerializer::toPathValue($phone_number_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_phone_number_delete_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_phone_number_delete_req));
            } else {
                $httpBody = $user_phone_number_delete_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'DELETE',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userPhoneNumberGet
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserPhoneNumberGetRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userPhoneNumberGet($user_id, $phone_number_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userPhoneNumberGet'][0])
    {
        list($response) = $this->userPhoneNumberGetWithHttpInfo($user_id, $phone_number_id, $remote_address, $user_agent, $contentType);
        return $response;
    }

    /**
     * Operation userPhoneNumberGetWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberGet'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserPhoneNumberGetRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userPhoneNumberGetWithHttpInfo($user_id, $phone_number_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userPhoneNumberGet'][0])
    {
        $request = $this->userPhoneNumberGetRequest($user_id, $phone_number_id, $remote_address, $user_agent, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserPhoneNumberGetRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserPhoneNumberGetRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserPhoneNumberGetRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserPhoneNumberGetRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserPhoneNumberGetRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userPhoneNumberGetAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userPhoneNumberGetAsync($user_id, $phone_number_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userPhoneNumberGet'][0])
    {
        return $this->userPhoneNumberGetAsyncWithHttpInfo($user_id, $phone_number_id, $remote_address, $user_agent, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userPhoneNumberGetAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userPhoneNumberGetAsyncWithHttpInfo($user_id, $phone_number_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userPhoneNumberGet'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserPhoneNumberGetRsp';
        $request = $this->userPhoneNumberGetRequest($user_id, $phone_number_id, $remote_address, $user_agent, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userPhoneNumberGet'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $phone_number_id ID of phone number (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userPhoneNumberGet'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userPhoneNumberGetRequest($user_id, $phone_number_id, $remote_address = null, $user_agent = null, string $contentType = self::contentTypes['userPhoneNumberGet'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userPhoneNumberGet'
            );
        }

        // verify the required parameter 'phone_number_id' is set
        if ($phone_number_id === null || (is_array($phone_number_id) && count($phone_number_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $phone_number_id when calling userPhoneNumberGet'
            );
        }




        $resourcePath = '/v1/users/{userID}/phoneNumbers/{phoneNumberID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);


        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }
        // path params
        if ($phone_number_id !== null) {
            $resourcePath = str_replace(
                '{' . 'phoneNumberID' . '}',
                ObjectSerializer::toPathValue($phone_number_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userStatsList
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userStatsList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserStatsListRsp
     */
    public function userStatsList($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userStatsList'][0])
    {
        list($response) = $this->userStatsListWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);
        return $response;
    }

    /**
     * Operation userStatsListWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userStatsList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserStatsListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userStatsListWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userStatsList'][0])
    {
        $request = $this->userStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserStatsListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserStatsListRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserStatsListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserStatsListRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserStatsListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userStatsListAsync
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userStatsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userStatsListAsync($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userStatsList'][0])
    {
        return $this->userStatsListAsyncWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userStatsListAsyncWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userStatsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userStatsListAsyncWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userStatsList'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserStatsListRsp';
        $request = $this->userStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userStatsList'
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userStatsList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userStatsListRequest($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['userStatsList'][0])
    {

        // verify the required parameter 'granularity' is set
        if ($granularity === null || (is_array($granularity) && count($granularity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $granularity when calling userStatsList'
            );
        }








        $resourcePath = '/v1/users/stats';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $remote_address,
            'remoteAddress', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $user_agent,
            'userAgent', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $sort,
            'sort', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $filter,
            'filter[]', // param base name
            'array', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page,
            'page', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $page_size,
            'pageSize', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $granularity,
            'granularity', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            true // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation userUpdate
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserUpdateReq $user_update_req user_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userUpdate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\UserUpdateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function userUpdate($user_id, $user_update_req, string $contentType = self::contentTypes['userUpdate'][0])
    {
        list($response) = $this->userUpdateWithHttpInfo($user_id, $user_update_req, $contentType);
        return $response;
    }

    /**
     * Operation userUpdateWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserUpdateReq $user_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userUpdate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\UserUpdateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function userUpdateWithHttpInfo($user_id, $user_update_req, string $contentType = self::contentTypes['userUpdate'][0])
    {
        $request = $this->userUpdateRequest($user_id, $user_update_req, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch($statusCode) {
                case 200:
                    if ('\Corbado\Generated\Model\UserUpdateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\UserUpdateRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\UserUpdateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\ErrorRsp' !== 'string') {
                            try {
                                $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                            } catch (\JsonException $exception) {
                                throw new ApiException(
                                    sprintf(
                                        'Error JSON decoding server response (%s)',
                                        $request->getUri()
                                    ),
                                    $statusCode,
                                    $response->getHeaders(),
                                    $content
                                );
                            }
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\UserUpdateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
                if ($returnType !== 'string') {
                    try {
                        $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                    } catch (\JsonException $exception) {
                        throw new ApiException(
                            sprintf(
                                'Error JSON decoding server response (%s)',
                                $request->getUri()
                            ),
                            $statusCode,
                            $response->getHeaders(),
                            $content
                        );
                    }
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\UserUpdateRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                default:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\Corbado\Generated\Model\ErrorRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation userUpdateAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserUpdateReq $user_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userUpdateAsync($user_id, $user_update_req, string $contentType = self::contentTypes['userUpdate'][0])
    {
        return $this->userUpdateAsyncWithHttpInfo($user_id, $user_update_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation userUpdateAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserUpdateReq $user_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function userUpdateAsyncWithHttpInfo($user_id, $user_update_req, string $contentType = self::contentTypes['userUpdate'][0])
    {
        $returnType = '\Corbado\Generated\Model\UserUpdateRsp';
        $request = $this->userUpdateRequest($user_id, $user_update_req, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'userUpdate'
     *
     * @param  string $user_id ID of user (required)
     * @param  \Corbado\Generated\Model\UserUpdateReq $user_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['userUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function userUpdateRequest($user_id, $user_update_req, string $contentType = self::contentTypes['userUpdate'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling userUpdate'
            );
        }

        // verify the required parameter 'user_update_req' is set
        if ($user_update_req === null || (is_array($user_update_req) && count($user_update_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_update_req when calling userUpdate'
            );
        }


        $resourcePath = '/v1/users/{userID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($user_id !== null) {
            $resourcePath = str_replace(
                '{' . 'userID' . '}',
                ObjectSerializer::toPathValue($user_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($user_update_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($user_update_req));
            } else {
                $httpBody = $user_update_req;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('X-Corbado-ProjectID');
        if ($apiKey !== null) {
            $headers['X-Corbado-ProjectID'] = $apiKey;
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }
}
