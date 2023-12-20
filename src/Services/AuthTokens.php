<?php

namespace Corbado\Services;

use Corbado\Exceptions\AssertException;
use Corbado\Exceptions\ServerException;
use Corbado\Exceptions\StandardException;
use Corbado\Generated\Api\AuthTokensApi;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\Generated\Model\AuthTokenValidateRsp;
use Corbado\Generated\Model\ErrorRsp;
use Corbado\Helper\Assert;
use Corbado\Helper\Helper;

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
