<?php
/**
 * PasskeyChallengesApi
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
 * PasskeyChallengesApi Class Doc Comment
 *
 * @category Class
 * @package  Corbado\Generated
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class PasskeyChallengesApi
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
        'passkeyChallengeList' => [
            'application/json',
        ],
        'passkeyChallengeUpdate' => [
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
     * Operation passkeyChallengeList
     *
     * @param  string $user_id ID of user (required)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\PasskeyChallengeList|\Corbado\Generated\Model\ErrorRsp
     */
    public function passkeyChallengeList($user_id, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['passkeyChallengeList'][0])
    {
        list($response) = $this->passkeyChallengeListWithHttpInfo($user_id, $sort, $filter, $page, $page_size, $contentType);
        return $response;
    }

    /**
     * Operation passkeyChallengeListWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeList'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\PasskeyChallengeList|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function passkeyChallengeListWithHttpInfo($user_id, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['passkeyChallengeList'][0])
    {
        $request = $this->passkeyChallengeListRequest($user_id, $sort, $filter, $page, $page_size, $contentType);

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
                    if ('\Corbado\Generated\Model\PasskeyChallengeList' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\PasskeyChallengeList' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\PasskeyChallengeList', []),
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

            $returnType = '\Corbado\Generated\Model\PasskeyChallengeList';
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
                        '\Corbado\Generated\Model\PasskeyChallengeList',
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
     * Operation passkeyChallengeListAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function passkeyChallengeListAsync($user_id, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['passkeyChallengeList'][0])
    {
        return $this->passkeyChallengeListAsyncWithHttpInfo($user_id, $sort, $filter, $page, $page_size, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation passkeyChallengeListAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function passkeyChallengeListAsyncWithHttpInfo($user_id, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['passkeyChallengeList'][0])
    {
        $returnType = '\Corbado\Generated\Model\PasskeyChallengeList';
        $request = $this->passkeyChallengeListRequest($user_id, $sort, $filter, $page, $page_size, $contentType);

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
     * Create request for operation 'passkeyChallengeList'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $sort Field sorting (optional)
     * @param  string[] $filter Field filtering (optional)
     * @param  int $page Page number (optional, default to 1)
     * @param  int $page_size Number of items per page (optional, default to 10)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function passkeyChallengeListRequest($user_id, $sort = null, $filter = null, $page = 1, $page_size = 10, string $contentType = self::contentTypes['passkeyChallengeList'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling passkeyChallengeList'
            );
        }






        $resourcePath = '/users/{userID}/passkeyChallenges';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

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
     * Operation passkeyChallengeUpdate
     *
     * @param  string $user_id ID of user (required)
     * @param  string $passkey_challenge_id ID of a passkey challenge (required)
     * @param  \Corbado\Generated\Model\PasskeyChallengeUpdateReq $passkey_challenge_update_req passkey_challenge_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeUpdate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \Corbado\Generated\Model\PasskeyChallenge|\Corbado\Generated\Model\ErrorRsp
     */
    public function passkeyChallengeUpdate($user_id, $passkey_challenge_id, $passkey_challenge_update_req, string $contentType = self::contentTypes['passkeyChallengeUpdate'][0])
    {
        list($response) = $this->passkeyChallengeUpdateWithHttpInfo($user_id, $passkey_challenge_id, $passkey_challenge_update_req, $contentType);
        return $response;
    }

    /**
     * Operation passkeyChallengeUpdateWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $passkey_challenge_id ID of a passkey challenge (required)
     * @param  \Corbado\Generated\Model\PasskeyChallengeUpdateReq $passkey_challenge_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeUpdate'] to see the possible values for this operation
     *
     * @throws \Corbado\Generated\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \Corbado\Generated\Model\PasskeyChallenge|\Corbado\Generated\Model\ErrorRsp, HTTP status code, HTTP response headers (array of strings)
     */
    public function passkeyChallengeUpdateWithHttpInfo($user_id, $passkey_challenge_id, $passkey_challenge_update_req, string $contentType = self::contentTypes['passkeyChallengeUpdate'][0])
    {
        $request = $this->passkeyChallengeUpdateRequest($user_id, $passkey_challenge_id, $passkey_challenge_update_req, $contentType);

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
                    if ('\Corbado\Generated\Model\PasskeyChallenge' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ('\Corbado\Generated\Model\PasskeyChallenge' !== 'string') {
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
                        ObjectSerializer::deserialize($content, '\Corbado\Generated\Model\PasskeyChallenge', []),
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

            $returnType = '\Corbado\Generated\Model\PasskeyChallenge';
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
                        '\Corbado\Generated\Model\PasskeyChallenge',
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
     * Operation passkeyChallengeUpdateAsync
     *
     * @param  string $user_id ID of user (required)
     * @param  string $passkey_challenge_id ID of a passkey challenge (required)
     * @param  \Corbado\Generated\Model\PasskeyChallengeUpdateReq $passkey_challenge_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function passkeyChallengeUpdateAsync($user_id, $passkey_challenge_id, $passkey_challenge_update_req, string $contentType = self::contentTypes['passkeyChallengeUpdate'][0])
    {
        return $this->passkeyChallengeUpdateAsyncWithHttpInfo($user_id, $passkey_challenge_id, $passkey_challenge_update_req, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation passkeyChallengeUpdateAsyncWithHttpInfo
     *
     * @param  string $user_id ID of user (required)
     * @param  string $passkey_challenge_id ID of a passkey challenge (required)
     * @param  \Corbado\Generated\Model\PasskeyChallengeUpdateReq $passkey_challenge_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function passkeyChallengeUpdateAsyncWithHttpInfo($user_id, $passkey_challenge_id, $passkey_challenge_update_req, string $contentType = self::contentTypes['passkeyChallengeUpdate'][0])
    {
        $returnType = '\Corbado\Generated\Model\PasskeyChallenge';
        $request = $this->passkeyChallengeUpdateRequest($user_id, $passkey_challenge_id, $passkey_challenge_update_req, $contentType);

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
     * Create request for operation 'passkeyChallengeUpdate'
     *
     * @param  string $user_id ID of user (required)
     * @param  string $passkey_challenge_id ID of a passkey challenge (required)
     * @param  \Corbado\Generated\Model\PasskeyChallengeUpdateReq $passkey_challenge_update_req (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['passkeyChallengeUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function passkeyChallengeUpdateRequest($user_id, $passkey_challenge_id, $passkey_challenge_update_req, string $contentType = self::contentTypes['passkeyChallengeUpdate'][0])
    {

        // verify the required parameter 'user_id' is set
        if ($user_id === null || (is_array($user_id) && count($user_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $user_id when calling passkeyChallengeUpdate'
            );
        }

        // verify the required parameter 'passkey_challenge_id' is set
        if ($passkey_challenge_id === null || (is_array($passkey_challenge_id) && count($passkey_challenge_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $passkey_challenge_id when calling passkeyChallengeUpdate'
            );
        }

        // verify the required parameter 'passkey_challenge_update_req' is set
        if ($passkey_challenge_update_req === null || (is_array($passkey_challenge_update_req) && count($passkey_challenge_update_req) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $passkey_challenge_update_req when calling passkeyChallengeUpdate'
            );
        }


        $resourcePath = '/users/{userID}/passkeyChallenges/{passkeyChallengeID}';
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
        if ($passkey_challenge_id !== null) {
            $resourcePath = str_replace(
                '{' . 'passkeyChallengeID' . '}',
                ObjectSerializer::toPathValue($passkey_challenge_id),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($passkey_challenge_update_req)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($passkey_challenge_update_req));
            } else {
                $httpBody = $passkey_challenge_update_req;
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
            'PATCH',
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
