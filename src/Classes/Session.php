<?php

namespace Corbado\Classes;

use Corbado\Classes\Exceptions\Http;
use Corbado\Classes\Exceptions\Standard;
use Corbado\Generated\Model\ClientInfo;
use Corbado\Generated\Model\SessionTokenVerifyReq;
use Corbado\Generated\Model\SessionTokenVerifyRsp;
use Corbado\Generated\Model\SessionTokenVerifyRspAllOfData;
use Firebase\JWT\CachedKeySet;
use Firebase\JWT\JWT;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Request;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use stdClass;
use Throwable;

class Session implements SessionInterface
{

    private string $version;
    private string $shortSessionCookieName;
    private string $issuer;
    private string $jwksURI;
    private ClientInterface $client;
    private CacheItemPoolInterface $jwksCachePool;

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function __construct(string $version, string $shortSessionCookieName, string $issuer, string $jwksURI, ClientInterface $client, CacheItemPoolInterface $jwksCachePool)
    {
        Assert::stringNotEmpty($version);
        Assert::stringNotEmpty($shortSessionCookieName);
        Assert::stringNotEmpty($issuer);
        Assert::stringNotEmpty($jwksURI);

        $this->version = $version;
        $this->shortSessionCookieName = $shortSessionCookieName;
        $this->issuer = $issuer;
        $this->jwksURI = $jwksURI;
        $this->client = $client;
        $this->jwksCachePool = $jwksCachePool;
    }

    /**
     * Returns the short-term session (represented as JWT) value from the cookie or the Authorization header
     *
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    public function getShortSessionValue() : string
    {
        if ($this->version === 'v1') {
            throw new \LogicException('This is only available on session v2');
        }

        if (!empty($_COOKIE[$this->shortSessionCookieName])) {
            return $_COOKIE[$this->shortSessionCookieName];
        }

        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return $this->extractBearerToken($_SERVER['HTTP_AUTHORIZATION']);
        }

        return '';
    }

    /**
     * Validates the given short-term session (represented as JWT) value
     *
     * @param string $value Value (JWT)
     * @return stdClass|null
     */
    public function validateShortSessionValue(string $value) : ?stdClass
    {
        if ($this->version === 'v1') {
            throw new \LogicException('This is only available on session v2');
        }

        try {
            Assert::stringNotEmpty($value);

            $keySet = new CachedKeySet(
                $this->jwksURI,
                $this->client,
                new HttpFactory(),
                $this->jwksCachePool,
                null,
                true
            );

            $decoded = JWT::decode($value, $keySet);

            $issuerValid = false;
            if ($decoded->iss === $this->issuer) {
                $issuerValid = true;
            }

            if ($issuerValid === true) {
                return $decoded;
            }

            return null;
        } catch (Throwable $e) {
            return null;
        }
    }

    /**
     */
    public function getCurrentUser() : User
    {
        if ($this->version === 'v1') {
            throw new \LogicException('This is only available on session v2');
        }

        $guest = new User(false);

        $value = $this->getShortSessionValue();
        if (strlen($value) < 10) {
            return $guest;
        }

        $decoded = $this->validateShortSessionValue($value);
        if ($decoded !== null) {
            return new User(
                true,
                $decoded->sub,
                $decoded->name,
                $decoded->email,
                $decoded->phoneNumber
            );
        }

        return $guest;
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     */
    private function extractBearerToken(string $authorizationHeader) : string {
        Assert::stringNotEmpty($authorizationHeader);

        if (!str_starts_with($authorizationHeader, 'Bearer ')) {
            return '';
        }

        return substr($authorizationHeader, 7);
    }

    /**
     * @throws \Corbado\Classes\Exceptions\Assert
     * @throws Http
     * @throws GuzzleException
     * @throws Standard
     * @throws ClientExceptionInterface
     * @deprecated
     */
    public function verify(string $sessionToken, string $remoteAddress, string $userAgent, string $requestID = ''): SessionTokenVerifyRsp
    {
        if ($this->version === 'v2') {
            throw new \LogicException('This is only available on session v1');
        }

        Assert::stringNotEmpty($sessionToken);
        Assert::stringNotEmpty($remoteAddress);
        Assert::stringNotEmpty($userAgent);

        $request = new SessionTokenVerifyReq();
        $request->setToken($sessionToken);
        $request->setRequestId($requestID);
        $request->setClientInfo(
            (new ClientInfo())->setRemoteAddress($remoteAddress)->setUserAgent($userAgent)
        );

        $httpResponse = $this->client->sendRequest(
            new Request(
                'POST',
                'sessions/verify',
                ['body' => Helper::jsonEncode($request->jsonSerialize())]
            )
        );

        $json = Helper::jsonDecode($httpResponse->getBody()->getContents());
        if (Helper::isErrorHttpStatusCode($json['httpStatusCode'])) {
            Helper::throwException($json);
        }

        $data = new SessionTokenVerifyRspAllOfData();
        $data->setUserId($json['data']['userID']);
        $data->setUserData($json['data']['userData']);

        $response = new SessionTokenVerifyRsp();
        $response->setData($data);

        return $response;
    }
}
