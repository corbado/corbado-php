<?php

use Corbado\Configuration;
use Corbado\Generated\ApiException;
use Corbado\Generated\Model\AuthTokenValidateReq;
use Corbado\Generated\Model\AuthTokenValidateRsp;
use Corbado\SDK;

require_once __DIR__ . '/../vendor/autoload.php';

$config = new Configuration('pro-771306541694234650', 'xxx');
$corbado = new SDK($config);

$corbadoAuthToken = '6GQd8ZgoCLlWld5lY25Dc8wYGLksvvRyaoxYrStX3o4WvKwcKGXWHiHtziTrEYss';
$remoteAddress = $_SERVER['HTTP_USER_AGENT'];
$userAgent = $_SERVER['REMOTE_ADDR'];

try {
    $request = new AuthTokenValidateReq();
    $request->setToken($corbadoAuthToken);
    $request->setClientInfo(SDK::createClientInfo($remoteAddress, $userAgent));

    $response = $corbado->authTokens()->validate($request);

    echo $response->getData()->getUserId();

} catch (ApiException $e) {
    echo $e->getMessage();
    echo "\n";

    $body = $e->getResponseBody();
    if (is_string($body)) {
        echo $body;
    } else {
        var_dump($body);
    }

} catch (Throwable $e) {
    echo $e->getMessage();
}