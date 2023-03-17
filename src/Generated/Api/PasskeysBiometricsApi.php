<?php
/**
 * PasskeysBiometricsApi
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

namespace Corbado\Generated\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Corbado\Generated\ApiException;
use Corbado\Generated\Configuration;
use Corbado\Generated\HeaderSelector;
use Corbado\Generated\ObjectSerializer;

/**
 * PasskeysBiometricsApi Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PasskeysBiometricsApi
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
     * Operation webAuthnAuthenticateFinish
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req web_authn_finish_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnAuthenticateFinish($web_authn_finish_req)
    {
        list($response) = $this->webAuthnAuthenticateFinishWithHttpInfo($web_authn_finish_req);
        return $response;
    }

    /**
     * Operation webAuthnAuthenticateFinishWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnAuthenticateFinishWithHttpInfo($web_authn_finish_req)
    {
        $request = $this->webAuthnAuthenticateFinishRequest($web_authn_finish_req);

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
                    if ('\Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp',
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
     * Operation webAuthnAuthenticateFinishAsync
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnAuthenticateFinishAsync($web_authn_finish_req)
    {
        return $this->webAuthnAuthenticateFinishAsyncWithHttpInfo($web_authn_finish_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnAuthenticateFinishAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnAuthenticateFinishAsyncWithHttpInfo($web_authn_finish_req)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnAuthenticateFinishRsp';
        $request = $this->webAuthnAuthenticateFinishRequest($web_authn_finish_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnAuthenticateFinish'
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnAuthenticateFinishRequest($web_authn_finish_req)
    {
        // verify the required parameter 'web_authn_finish_req' is set
        if ($web_authn_finish_req === null || (is_array($web_authn_finish_req) && count($web_authn_finish_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $web_authn_finish_req when calling webAuthnAuthenticateFinish'
            );
        }

        $resourcePath = '/v1/webauthn/authenticate/finish';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($web_authn_finish_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($web_authn_finish_req));
            } else {
                $httpBody = $web_authn_finish_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
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

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnAuthenticateStart
     *
     * @param  \Corbado\Generated\Model\WebAuthnAuthenticateStartReq $web_authn_authenticate_start_req web_authn_authenticate_start_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnAuthenticateStartRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnAuthenticateStart($web_authn_authenticate_start_req)
    {
        list($response) = $this->webAuthnAuthenticateStartWithHttpInfo($web_authn_authenticate_start_req);
        return $response;
    }

    /**
     * Operation webAuthnAuthenticateStartWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnAuthenticateStartReq $web_authn_authenticate_start_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnAuthenticateStartRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnAuthenticateStartWithHttpInfo($web_authn_authenticate_start_req)
    {
        $request = $this->webAuthnAuthenticateStartRequest($web_authn_authenticate_start_req);

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
                    if ('\Corbado\Generated\Model\WebAuthnAuthenticateStartRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnAuthenticateStartRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnAuthenticateStartRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnAuthenticateStartRsp',
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
     * Operation webAuthnAuthenticateStartAsync
     *
     * @param  \Corbado\Generated\Model\WebAuthnAuthenticateStartReq $web_authn_authenticate_start_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnAuthenticateStartAsync($web_authn_authenticate_start_req)
    {
        return $this->webAuthnAuthenticateStartAsyncWithHttpInfo($web_authn_authenticate_start_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnAuthenticateStartAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnAuthenticateStartReq $web_authn_authenticate_start_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnAuthenticateStartAsyncWithHttpInfo($web_authn_authenticate_start_req)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnAuthenticateStartRsp';
        $request = $this->webAuthnAuthenticateStartRequest($web_authn_authenticate_start_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnAuthenticateStart'
     *
     * @param  \Corbado\Generated\Model\WebAuthnAuthenticateStartReq $web_authn_authenticate_start_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnAuthenticateStartRequest($web_authn_authenticate_start_req)
    {
        // verify the required parameter 'web_authn_authenticate_start_req' is set
        if ($web_authn_authenticate_start_req === null || (is_array($web_authn_authenticate_start_req) && count($web_authn_authenticate_start_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $web_authn_authenticate_start_req when calling webAuthnAuthenticateStart'
            );
        }

        $resourcePath = '/v1/webauthn/authenticate/start';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($web_authn_authenticate_start_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($web_authn_authenticate_start_req));
            } else {
                $httpBody = $web_authn_authenticate_start_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
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

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnCredentialList
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnCredentialListRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnCredentialList($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->webAuthnCredentialListWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation webAuthnCredentialListWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnCredentialListRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnCredentialListWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->webAuthnCredentialListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\WebAuthnCredentialListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnCredentialListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnCredentialListRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnCredentialListRsp',
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
     * Operation webAuthnCredentialListAsync
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnCredentialListAsync($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->webAuthnCredentialListAsyncWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnCredentialListAsyncWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnCredentialListAsyncWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnCredentialListRsp';
        $request = $this->webAuthnCredentialListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnCredentialList'
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnCredentialListRequest($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {

        $resourcePath = '/v1/webauthn/credential';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($remote_address)) {
            $remote_address = ObjectSerializer::serializeCollection($remote_address, '', true);
        }
        if ($remote_address !== null) {
            $queryParams['remoteAddress'] = $remote_address;
        }
        // query params
        if (is_array($user_agent)) {
            $user_agent = ObjectSerializer::serializeCollection($user_agent, '', true);
        }
        if ($user_agent !== null) {
            $queryParams['userAgent'] = $user_agent;
        }
        // query params
        if (is_array($sort)) {
            $sort = ObjectSerializer::serializeCollection($sort, '', true);
        }
        if ($sort !== null) {
            $queryParams['sort'] = $sort;
        }
        // query params
        if ($filter !== null) {
            if('form' === 'form' && is_array($filter)) {
                foreach($filter as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[]'] = $filter;
            }
        }
        // query params
        if (is_array($page)) {
            $page = ObjectSerializer::serializeCollection($page, '', true);
        }
        if ($page !== null) {
            $queryParams['page'] = $page;
        }
        // query params
        if (is_array($page_size)) {
            $page_size = ObjectSerializer::serializeCollection($page_size, '', true);
        }
        if ($page_size !== null) {
            $queryParams['pageSize'] = $page_size;
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnCredentialUpdate
     *
     * @param  string $credential_id ID of credential (required)
     * @param  \Corbado\Generated\Model\WebAuthnCredentialReq $web_authn_credential_req web_authn_credential_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnCredentialRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnCredentialUpdate($credential_id, $web_authn_credential_req)
    {
        list($response) = $this->webAuthnCredentialUpdateWithHttpInfo($credential_id, $web_authn_credential_req);
        return $response;
    }

    /**
     * Operation webAuthnCredentialUpdateWithHttpInfo
     *
     * @param  string $credential_id ID of credential (required)
     * @param  \Corbado\Generated\Model\WebAuthnCredentialReq $web_authn_credential_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnCredentialRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnCredentialUpdateWithHttpInfo($credential_id, $web_authn_credential_req)
    {
        $request = $this->webAuthnCredentialUpdateRequest($credential_id, $web_authn_credential_req);

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
                    if ('\Corbado\Generated\Model\WebAuthnCredentialRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnCredentialRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnCredentialRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnCredentialRsp',
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
     * Operation webAuthnCredentialUpdateAsync
     *
     * @param  string $credential_id ID of credential (required)
     * @param  \Corbado\Generated\Model\WebAuthnCredentialReq $web_authn_credential_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnCredentialUpdateAsync($credential_id, $web_authn_credential_req)
    {
        return $this->webAuthnCredentialUpdateAsyncWithHttpInfo($credential_id, $web_authn_credential_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnCredentialUpdateAsyncWithHttpInfo
     *
     * @param  string $credential_id ID of credential (required)
     * @param  \Corbado\Generated\Model\WebAuthnCredentialReq $web_authn_credential_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnCredentialUpdateAsyncWithHttpInfo($credential_id, $web_authn_credential_req)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnCredentialRsp';
        $request = $this->webAuthnCredentialUpdateRequest($credential_id, $web_authn_credential_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnCredentialUpdate'
     *
     * @param  string $credential_id ID of credential (required)
     * @param  \Corbado\Generated\Model\WebAuthnCredentialReq $web_authn_credential_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnCredentialUpdateRequest($credential_id, $web_authn_credential_req)
    {
        // verify the required parameter 'credential_id' is set
        if ($credential_id === null || (is_array($credential_id) && count($credential_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $credential_id when calling webAuthnCredentialUpdate'
            );
        }
        // verify the required parameter 'web_authn_credential_req' is set
        if ($web_authn_credential_req === null || (is_array($web_authn_credential_req) && count($web_authn_credential_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $web_authn_credential_req when calling webAuthnCredentialUpdate'
            );
        }

        $resourcePath = '/v1/webauthn/credential/{credentialID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($credential_id !== null) {
            $resourcePath = str_replace(
                '{' . 'credentialID' . '}',
                ObjectSerializer::toPathValue($credential_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($web_authn_credential_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($web_authn_credential_req));
            } else {
                $httpBody = $web_authn_credential_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
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

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnMediationStart
     *
     * @param  \Corbado\Generated\Model\WebAuthnMediationStartReq $web_authn_mediation_start_req web_authn_mediation_start_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnMediationStartRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnMediationStart($web_authn_mediation_start_req)
    {
        list($response) = $this->webAuthnMediationStartWithHttpInfo($web_authn_mediation_start_req);
        return $response;
    }

    /**
     * Operation webAuthnMediationStartWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnMediationStartReq $web_authn_mediation_start_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnMediationStartRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnMediationStartWithHttpInfo($web_authn_mediation_start_req)
    {
        $request = $this->webAuthnMediationStartRequest($web_authn_mediation_start_req);

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
                    if ('\Corbado\Generated\Model\WebAuthnMediationStartRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnMediationStartRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnMediationStartRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnMediationStartRsp',
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
     * Operation webAuthnMediationStartAsync
     *
     * @param  \Corbado\Generated\Model\WebAuthnMediationStartReq $web_authn_mediation_start_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnMediationStartAsync($web_authn_mediation_start_req)
    {
        return $this->webAuthnMediationStartAsyncWithHttpInfo($web_authn_mediation_start_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnMediationStartAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnMediationStartReq $web_authn_mediation_start_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnMediationStartAsyncWithHttpInfo($web_authn_mediation_start_req)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnMediationStartRsp';
        $request = $this->webAuthnMediationStartRequest($web_authn_mediation_start_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnMediationStart'
     *
     * @param  \Corbado\Generated\Model\WebAuthnMediationStartReq $web_authn_mediation_start_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnMediationStartRequest($web_authn_mediation_start_req)
    {
        // verify the required parameter 'web_authn_mediation_start_req' is set
        if ($web_authn_mediation_start_req === null || (is_array($web_authn_mediation_start_req) && count($web_authn_mediation_start_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $web_authn_mediation_start_req when calling webAuthnMediationStart'
            );
        }

        $resourcePath = '/v1/webauthn/mediation/start';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($web_authn_mediation_start_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($web_authn_mediation_start_req));
            } else {
                $httpBody = $web_authn_mediation_start_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
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

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnRegisterFinish
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req web_authn_finish_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnRegisterFinishRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnRegisterFinish($web_authn_finish_req)
    {
        list($response) = $this->webAuthnRegisterFinishWithHttpInfo($web_authn_finish_req);
        return $response;
    }

    /**
     * Operation webAuthnRegisterFinishWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnRegisterFinishRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnRegisterFinishWithHttpInfo($web_authn_finish_req)
    {
        $request = $this->webAuthnRegisterFinishRequest($web_authn_finish_req);

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
                    if ('\Corbado\Generated\Model\WebAuthnRegisterFinishRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnRegisterFinishRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnRegisterFinishRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnRegisterFinishRsp',
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
     * Operation webAuthnRegisterFinishAsync
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnRegisterFinishAsync($web_authn_finish_req)
    {
        return $this->webAuthnRegisterFinishAsyncWithHttpInfo($web_authn_finish_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnRegisterFinishAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnRegisterFinishAsyncWithHttpInfo($web_authn_finish_req)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnRegisterFinishRsp';
        $request = $this->webAuthnRegisterFinishRequest($web_authn_finish_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnRegisterFinish'
     *
     * @param  \Corbado\Generated\Model\WebAuthnFinishReq $web_authn_finish_req (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnRegisterFinishRequest($web_authn_finish_req)
    {
        // verify the required parameter 'web_authn_finish_req' is set
        if ($web_authn_finish_req === null || (is_array($web_authn_finish_req) && count($web_authn_finish_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $web_authn_finish_req when calling webAuthnRegisterFinish'
            );
        }

        $resourcePath = '/v1/webauthn/register/finish';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($web_authn_finish_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($web_authn_finish_req));
            } else {
                $httpBody = $web_authn_finish_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
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

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnRegisterStart
     *
     * @param  \Corbado\Generated\Model\WebAuthnRegisterStartReq $web_authn_register_start_req web_authn_register_start_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebAuthnRegisterStartRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnRegisterStart($web_authn_register_start_req = null)
    {
        list($response) = $this->webAuthnRegisterStartWithHttpInfo($web_authn_register_start_req);
        return $response;
    }

    /**
     * Operation webAuthnRegisterStartWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnRegisterStartReq $web_authn_register_start_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebAuthnRegisterStartRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnRegisterStartWithHttpInfo($web_authn_register_start_req = null)
    {
        $request = $this->webAuthnRegisterStartRequest($web_authn_register_start_req);

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
                    if ('\Corbado\Generated\Model\WebAuthnRegisterStartRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebAuthnRegisterStartRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebAuthnRegisterStartRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebAuthnRegisterStartRsp',
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
     * Operation webAuthnRegisterStartAsync
     *
     * @param  \Corbado\Generated\Model\WebAuthnRegisterStartReq $web_authn_register_start_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnRegisterStartAsync($web_authn_register_start_req = null)
    {
        return $this->webAuthnRegisterStartAsyncWithHttpInfo($web_authn_register_start_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnRegisterStartAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebAuthnRegisterStartReq $web_authn_register_start_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnRegisterStartAsyncWithHttpInfo($web_authn_register_start_req = null)
    {
        $returnType = '\Corbado\Generated\Model\WebAuthnRegisterStartRsp';
        $request = $this->webAuthnRegisterStartRequest($web_authn_register_start_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnRegisterStart'
     *
     * @param  \Corbado\Generated\Model\WebAuthnRegisterStartReq $web_authn_register_start_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnRegisterStartRequest($web_authn_register_start_req = null)
    {

        $resourcePath = '/v1/webauthn/register/start';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($web_authn_register_start_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($web_authn_register_start_req));
            } else {
                $httpBody = $web_authn_register_start_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
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

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnSettingCreate
     *
     * @param  \Corbado\Generated\Model\WebauthnSettingCreateReq $webauthn_setting_create_req webauthn_setting_create_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebauthnSettingCreateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnSettingCreate($webauthn_setting_create_req = null)
    {
        list($response) = $this->webAuthnSettingCreateWithHttpInfo($webauthn_setting_create_req);
        return $response;
    }

    /**
     * Operation webAuthnSettingCreateWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebauthnSettingCreateReq $webauthn_setting_create_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebauthnSettingCreateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnSettingCreateWithHttpInfo($webauthn_setting_create_req = null)
    {
        $request = $this->webAuthnSettingCreateRequest($webauthn_setting_create_req);

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
                    if ('\Corbado\Generated\Model\WebauthnSettingCreateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebauthnSettingCreateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebauthnSettingCreateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebauthnSettingCreateRsp',
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
     * Operation webAuthnSettingCreateAsync
     *
     * @param  \Corbado\Generated\Model\WebauthnSettingCreateReq $webauthn_setting_create_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingCreateAsync($webauthn_setting_create_req = null)
    {
        return $this->webAuthnSettingCreateAsyncWithHttpInfo($webauthn_setting_create_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnSettingCreateAsyncWithHttpInfo
     *
     * @param  \Corbado\Generated\Model\WebauthnSettingCreateReq $webauthn_setting_create_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingCreateAsyncWithHttpInfo($webauthn_setting_create_req = null)
    {
        $returnType = '\Corbado\Generated\Model\WebauthnSettingCreateRsp';
        $request = $this->webAuthnSettingCreateRequest($webauthn_setting_create_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnSettingCreate'
     *
     * @param  \Corbado\Generated\Model\WebauthnSettingCreateReq $webauthn_setting_create_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnSettingCreateRequest($webauthn_setting_create_req = null)
    {

        $resourcePath = '/v1/webauthn/settings';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($webauthn_setting_create_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($webauthn_setting_create_req));
            } else {
                $httpBody = $webauthn_setting_create_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnSettingDelete
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingDeleteReq $webauthn_setting_delete_req webauthn_setting_delete_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnSettingDelete($setting_id, $webauthn_setting_delete_req = null)
    {
        list($response) = $this->webAuthnSettingDeleteWithHttpInfo($setting_id, $webauthn_setting_delete_req);
        return $response;
    }

    /**
     * Operation webAuthnSettingDeleteWithHttpInfo
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingDeleteReq $webauthn_setting_delete_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\GenericRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnSettingDeleteWithHttpInfo($setting_id, $webauthn_setting_delete_req = null)
    {
        $request = $this->webAuthnSettingDeleteRequest($setting_id, $webauthn_setting_delete_req);

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
     * Operation webAuthnSettingDeleteAsync
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingDeleteReq $webauthn_setting_delete_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingDeleteAsync($setting_id, $webauthn_setting_delete_req = null)
    {
        return $this->webAuthnSettingDeleteAsyncWithHttpInfo($setting_id, $webauthn_setting_delete_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnSettingDeleteAsyncWithHttpInfo
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingDeleteReq $webauthn_setting_delete_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingDeleteAsyncWithHttpInfo($setting_id, $webauthn_setting_delete_req = null)
    {
        $returnType = '\Corbado\Generated\Model\GenericRsp';
        $request = $this->webAuthnSettingDeleteRequest($setting_id, $webauthn_setting_delete_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnSettingDelete'
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingDeleteReq $webauthn_setting_delete_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnSettingDeleteRequest($setting_id, $webauthn_setting_delete_req = null)
    {
        // verify the required parameter 'setting_id' is set
        if ($setting_id === null || (is_array($setting_id) && count($setting_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $setting_id when calling webAuthnSettingDelete'
            );
        }

        $resourcePath = '/v1/webauthn/settings/{settingID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($setting_id !== null) {
            $resourcePath = str_replace(
                '{' . 'settingID' . '}',
                ObjectSerializer::toPathValue($setting_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($webauthn_setting_delete_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($webauthn_setting_delete_req));
            } else {
                $httpBody = $webauthn_setting_delete_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnSettingGet
     *
     * @param  string $setting_id ID from create (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebauthnSettingGetRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnSettingGet($setting_id)
    {
        list($response) = $this->webAuthnSettingGetWithHttpInfo($setting_id);
        return $response;
    }

    /**
     * Operation webAuthnSettingGetWithHttpInfo
     *
     * @param  string $setting_id ID from create (required)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebauthnSettingGetRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnSettingGetWithHttpInfo($setting_id)
    {
        $request = $this->webAuthnSettingGetRequest($setting_id);

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
                    if ('\Corbado\Generated\Model\WebauthnSettingGetRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebauthnSettingGetRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebauthnSettingGetRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebauthnSettingGetRsp',
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
     * Operation webAuthnSettingGetAsync
     *
     * @param  string $setting_id ID from create (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingGetAsync($setting_id)
    {
        return $this->webAuthnSettingGetAsyncWithHttpInfo($setting_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnSettingGetAsyncWithHttpInfo
     *
     * @param  string $setting_id ID from create (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingGetAsyncWithHttpInfo($setting_id)
    {
        $returnType = '\Corbado\Generated\Model\WebauthnSettingGetRsp';
        $request = $this->webAuthnSettingGetRequest($setting_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnSettingGet'
     *
     * @param  string $setting_id ID from create (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnSettingGetRequest($setting_id)
    {
        // verify the required parameter 'setting_id' is set
        if ($setting_id === null || (is_array($setting_id) && count($setting_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $setting_id when calling webAuthnSettingGet'
            );
        }

        $resourcePath = '/v1/webauthn/settings/{settingID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($setting_id !== null) {
            $resourcePath = str_replace(
                '{' . 'settingID' . '}',
                ObjectSerializer::toPathValue($setting_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnSettingList
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebauthnSettingListRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnSettingList($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->webAuthnSettingListWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation webAuthnSettingListWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebauthnSettingListRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnSettingListWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->webAuthnSettingListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\WebauthnSettingListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebauthnSettingListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebauthnSettingListRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebauthnSettingListRsp',
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
     * Operation webAuthnSettingListAsync
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingListAsync($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->webAuthnSettingListAsyncWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnSettingListAsyncWithHttpInfo
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingListAsyncWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\WebauthnSettingListRsp';
        $request = $this->webAuthnSettingListRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnSettingList'
     *
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnSettingListRequest($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {

        $resourcePath = '/v1/webauthn/settings';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if (is_array($remote_address)) {
            $remote_address = ObjectSerializer::serializeCollection($remote_address, '', true);
        }
        if ($remote_address !== null) {
            $queryParams['remoteAddress'] = $remote_address;
        }
        // query params
        if (is_array($user_agent)) {
            $user_agent = ObjectSerializer::serializeCollection($user_agent, '', true);
        }
        if ($user_agent !== null) {
            $queryParams['userAgent'] = $user_agent;
        }
        // query params
        if (is_array($sort)) {
            $sort = ObjectSerializer::serializeCollection($sort, '', true);
        }
        if ($sort !== null) {
            $queryParams['sort'] = $sort;
        }
        // query params
        if ($filter !== null) {
            if('form' === 'form' && is_array($filter)) {
                foreach($filter as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['filter[]'] = $filter;
            }
        }
        // query params
        if (is_array($page)) {
            $page = ObjectSerializer::serializeCollection($page, '', true);
        }
        if ($page !== null) {
            $queryParams['page'] = $page;
        }
        // query params
        if (is_array($page_size)) {
            $page_size = ObjectSerializer::serializeCollection($page_size, '', true);
        }
        if ($page_size !== null) {
            $queryParams['pageSize'] = $page_size;
        }




        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation webAuthnSettingPut
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingUpdateReq $webauthn_setting_update_req webauthn_setting_update_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\WebauthnSettingUpdateRsp|\Corbado\Generated\Model\ErrorRsp
     */
    public function webAuthnSettingPut($setting_id, $webauthn_setting_update_req = null)
    {
        list($response) = $this->webAuthnSettingPutWithHttpInfo($setting_id, $webauthn_setting_update_req);
        return $response;
    }

    /**
     * Operation webAuthnSettingPutWithHttpInfo
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingUpdateReq $webauthn_setting_update_req (optional)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\WebauthnSettingUpdateRsp|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function webAuthnSettingPutWithHttpInfo($setting_id, $webauthn_setting_update_req = null)
    {
        $request = $this->webAuthnSettingPutRequest($setting_id, $webauthn_setting_update_req);

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
                    if ('\Corbado\Generated\Model\WebauthnSettingUpdateRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\WebauthnSettingUpdateRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                default:
                    if ('\Corbado\Generated\Model\ErrorRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\ErrorRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\WebauthnSettingUpdateRsp';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
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
                        '\Corbado\Generated\Model\WebauthnSettingUpdateRsp',
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
     * Operation webAuthnSettingPutAsync
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingUpdateReq $webauthn_setting_update_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingPutAsync($setting_id, $webauthn_setting_update_req = null)
    {
        return $this->webAuthnSettingPutAsyncWithHttpInfo($setting_id, $webauthn_setting_update_req)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation webAuthnSettingPutAsyncWithHttpInfo
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingUpdateReq $webauthn_setting_update_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function webAuthnSettingPutAsyncWithHttpInfo($setting_id, $webauthn_setting_update_req = null)
    {
        $returnType = '\Corbado\Generated\Model\WebauthnSettingUpdateRsp';
        $request = $this->webAuthnSettingPutRequest($setting_id, $webauthn_setting_update_req);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
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
     * Create request for operation 'webAuthnSettingPut'
     *
     * @param  string $setting_id ID from create (required)
     * @param  \Corbado\Generated\Model\WebauthnSettingUpdateReq $webauthn_setting_update_req (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function webAuthnSettingPutRequest($setting_id, $webauthn_setting_update_req = null)
    {
        // verify the required parameter 'setting_id' is set
        if ($setting_id === null || (is_array($setting_id) && count($setting_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $setting_id when calling webAuthnSettingPut'
            );
        }

        $resourcePath = '/v1/webauthn/settings/{settingID}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($setting_id !== null) {
            $resourcePath = str_replace(
                '{' . 'settingID' . '}',
                ObjectSerializer::toPathValue($setting_id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($webauthn_setting_update_req)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($webauthn_setting_update_req));
            } else {
                $httpBody = $webauthn_setting_update_req;
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

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires HTTP basic authentication
        if (!empty($this->config->getUsername()) || !(empty($this->config->getPassword()))) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }
        // this endpoint requires Bearer (JWT) authentication (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
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

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
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
