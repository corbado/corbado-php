<?php

namespace Corbado\Classes\Apis;

use Corbado\Classes\Assert;
use Corbado\Classes\Exceptions\AssertException;
use Corbado\Classes\Exceptions\ServerException;
use Corbado\Classes\Exceptions\StandardException;
use Corbado\Classes\Helper;
use Corbado\Generated\Api\AuthTokensApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\Generated\Model\AuthTokenValidateRsp;
use Corbado\Generated\Model\ErrorRsp;

class AuthTokens implements AuthTokensInterface
{
    private AuthTokensApi $client;

    /**
     * @throws AssertException
     */
    public function __construct(AuthTokensApi $client)
    {
        Assert::notNull($client);
        $this->client = $client;
    }

    /**
     * @param AuthTokenValidateReq $req
     * @return AuthTokenValidateRsp
     * @throws AssertException
     * @throws StandardException
     * @throws ServerException
     */
    public function validate(AuthTokenValidateReq $req): AuthTokenValidateRsp
    {
        Assert::notNull($req);

        try {
            $rsp = $this->client->authTokenValidate($req);
        } catch (ApiException $e) {
            throw Helper::convertToServerException($e);
        }

        if ($rsp instanceof ErrorRsp) {
            throw new StandardException('Got unexpected ErrorRsp');
        }

        return $rsp;
    }
}
