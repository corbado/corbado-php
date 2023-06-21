<?php

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $config = new \Corbado\Configuration('pro-771306541694234650', 'xxx');
    $corbado = new \Corbado\SDK($config);

    $clientInfo = new \Corbado\Generated\Model\ClientInfo();
    $clientInfo->setRemoteAddress('127.0.0.1');
    $clientInfo->setUserAgent('xxx');

    $request = new \Corbado\Generated\Model\AuthTokenValidateReq();
    $request->setToken('6GQd8ZgoCLlWld5lY25Dc8wYGLksvvRyaoxYrStX3o4WvKwcKGXWHiHtziTrEYss');
    $request->setClientInfo($clientInfo);

    $corbado->authTokens()->authTokenValidate($request);

} catch (Throwable $e) {
    echo $e->getMessage();
    echo $e->getResponseBody();
}