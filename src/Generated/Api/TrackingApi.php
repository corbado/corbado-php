<?php
/**
 * TrackingApi
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
 * TrackingApi Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class TrackingApi
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
     * Operation trackingAllRequest
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
     * @return \Corbado\Generated\Model\TrackingRawListRsp
     */
    public function trackingAllRequest($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->trackingAllRequestWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation trackingAllRequestWithHttpInfo
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
     * @return array of \Corbado\Generated\Model\TrackingRawListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function trackingAllRequestWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->trackingAllRequestRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\TrackingRawListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\TrackingRawListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\TrackingRawListRsp';
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
                        '\Corbado\Generated\Model\TrackingRawListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation trackingAllRequestAsync
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
    public function trackingAllRequestAsync($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->trackingAllRequestAsyncWithHttpInfo($remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation trackingAllRequestAsyncWithHttpInfo
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
    public function trackingAllRequestAsyncWithHttpInfo($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\TrackingRawListRsp';
        $request = $this->trackingAllRequestRequest($remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
     * Create request for operation 'trackingAllRequest'
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
    public function trackingAllRequestRequest($remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {

        $resourcePath = '/v1/tracking';
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
     * Operation trackingBrowserDetailedStatsList
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp
     */
    public function trackingBrowserDetailedStatsList($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->trackingBrowserDetailedStatsListWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation trackingBrowserDetailedStatsListWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function trackingBrowserDetailedStatsListWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->trackingBrowserDetailedStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp';
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
                        '\Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation trackingBrowserDetailedStatsListAsync
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingBrowserDetailedStatsListAsync($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->trackingBrowserDetailedStatsListAsyncWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation trackingBrowserDetailedStatsListAsyncWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingBrowserDetailedStatsListAsyncWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\TrackingBrowserDetailedStatsListRsp';
        $request = $this->trackingBrowserDetailedStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
     * Create request for operation 'trackingBrowserDetailedStatsList'
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingBrowserDetailedStatsListRequest($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        // verify the required parameter 'granularity' is set
        if ($granularity === null || (is_array($granularity) && count($granularity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $granularity when calling trackingBrowserDetailedStatsList'
            );
        }

        $resourcePath = '/v1/tracking/browser/stats/detailed';
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
        // query params
        if ($granularity !== null) {
            if('form' === 'form' && is_array($granularity)) {
                foreach($granularity as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['granularity'] = $granularity;
            }
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
     * Operation trackingBrowserStatsList
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\TrackingBrowserStatsListRsp
     */
    public function trackingBrowserStatsList($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->trackingBrowserStatsListWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation trackingBrowserStatsListWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\TrackingBrowserStatsListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function trackingBrowserStatsListWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->trackingBrowserStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\TrackingBrowserStatsListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\TrackingBrowserStatsListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\TrackingBrowserStatsListRsp';
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
                        '\Corbado\Generated\Model\TrackingBrowserStatsListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation trackingBrowserStatsListAsync
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingBrowserStatsListAsync($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->trackingBrowserStatsListAsyncWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation trackingBrowserStatsListAsyncWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingBrowserStatsListAsyncWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\TrackingBrowserStatsListRsp';
        $request = $this->trackingBrowserStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
     * Create request for operation 'trackingBrowserStatsList'
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingBrowserStatsListRequest($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        // verify the required parameter 'granularity' is set
        if ($granularity === null || (is_array($granularity) && count($granularity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $granularity when calling trackingBrowserStatsList'
            );
        }

        $resourcePath = '/v1/tracking/browser/stats';
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
        // query params
        if ($granularity !== null) {
            if('form' === 'form' && is_array($granularity)) {
                foreach($granularity as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['granularity'] = $granularity;
            }
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
     * Operation trackingOSDetailedStatsList
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\TrackingOSDetailedStatsListRsp
     */
    public function trackingOSDetailedStatsList($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->trackingOSDetailedStatsListWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation trackingOSDetailedStatsListWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\TrackingOSDetailedStatsListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function trackingOSDetailedStatsListWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->trackingOSDetailedStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\TrackingOSDetailedStatsListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\TrackingOSDetailedStatsListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\TrackingOSDetailedStatsListRsp';
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
                        '\Corbado\Generated\Model\TrackingOSDetailedStatsListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation trackingOSDetailedStatsListAsync
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingOSDetailedStatsListAsync($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->trackingOSDetailedStatsListAsyncWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation trackingOSDetailedStatsListAsyncWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingOSDetailedStatsListAsyncWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\TrackingOSDetailedStatsListRsp';
        $request = $this->trackingOSDetailedStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
     * Create request for operation 'trackingOSDetailedStatsList'
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingOSDetailedStatsListRequest($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        // verify the required parameter 'granularity' is set
        if ($granularity === null || (is_array($granularity) && count($granularity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $granularity when calling trackingOSDetailedStatsList'
            );
        }

        $resourcePath = '/v1/tracking/os/stats/detailed';
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
        // query params
        if ($granularity !== null) {
            if('form' === 'form' && is_array($granularity)) {
                foreach($granularity as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['granularity'] = $granularity;
            }
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
     * Operation trackingOSStatsList
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\TrackingOSStatsListRsp
     */
    public function trackingOSStatsList($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->trackingOSStatsListWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation trackingOSStatsListWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\TrackingOSStatsListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function trackingOSStatsListWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->trackingOSStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\TrackingOSStatsListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\TrackingOSStatsListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\TrackingOSStatsListRsp';
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
                        '\Corbado\Generated\Model\TrackingOSStatsListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation trackingOSStatsListAsync
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingOSStatsListAsync($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->trackingOSStatsListAsyncWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation trackingOSStatsListAsyncWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingOSStatsListAsyncWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\TrackingOSStatsListRsp';
        $request = $this->trackingOSStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
     * Create request for operation 'trackingOSStatsList'
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingOSStatsListRequest($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        // verify the required parameter 'granularity' is set
        if ($granularity === null || (is_array($granularity) && count($granularity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $granularity when calling trackingOSStatsList'
            );
        }

        $resourcePath = '/v1/tracking/os/stats';
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
        // query params
        if ($granularity !== null) {
            if('form' === 'form' && is_array($granularity)) {
                foreach($granularity as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['granularity'] = $granularity;
            }
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
     * Operation trackingStatsList
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\TrackingStatsListRsp
     */
    public function trackingStatsList($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        list($response) = $this->trackingStatsListWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);
        return $response;
    }

    /**
     * Operation trackingStatsListWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
     * @param  string $remote_address Client&#39;s remote address (optional)
     * @param  string $user_agent Client&#39;s user agent (optional)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\TrackingStatsListRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function trackingStatsListWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $request = $this->trackingStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
                    if ('\Corbado\Generated\Model\TrackingStatsListRsp' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\TrackingStatsListRsp', []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            $returnType = '\Corbado\Generated\Model\TrackingStatsListRsp';
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
                        '\Corbado\Generated\Model\TrackingStatsListRsp',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation trackingStatsListAsync
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingStatsListAsync($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        return $this->trackingStatsListAsyncWithHttpInfo($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation trackingStatsListAsyncWithHttpInfo
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingStatsListAsyncWithHttpInfo($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        $returnType = '\Corbado\Generated\Model\TrackingStatsListRsp';
        $request = $this->trackingStatsListRequest($granularity, $remote_address, $user_agent, $sort, $filter, $page, $page_size);

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
     * Create request for operation 'trackingStatsList'
     *
     * @param  string $granularity Data granularity (required)
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
    public function trackingStatsListRequest($granularity, $remote_address = null, $user_agent = null, $sort = null, $filter = null, $page = 1, $page_size = 10)
    {
        // verify the required parameter 'granularity' is set
        if ($granularity === null || (is_array($granularity) && count($granularity) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $granularity when calling trackingStatsList'
            );
        }

        $resourcePath = '/v1/tracking/stats';
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
        // query params
        if ($granularity !== null) {
            if('form' === 'form' && is_array($granularity)) {
                foreach($granularity as $key => $value) {
                    $queryParams[$key] = $value;
                }
            }
            else {
                $queryParams['granularity'] = $granularity;
            }
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
