<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = new \Corbado\Configuration('pro-771306541694234650', 'xxx');
$corbado = new \Corbado\SDK($config);

$corbadoAuthToken = '6GQd8ZgoCLlWld5lY25Dc8wYGLksvvRyaoxYrStX3o4WvKwcKGXWHiHtziTrEYss';
$remoteAddress = $_SERVER['HTTP_USER_AGENT'];
$userAgent = $_SERVER['REMOTE_ADDR'];

try {
    $request = new \Corbado\Generated\Model\AuthTokenValidateReq();
    $request->setToken($corbadoAuthToken);
    $request->setClientInfo(\Corbado\SDK::createClientInfo($remoteAddress, $userAgent));

    /** @var \Corbado\Generated\Model\AuthTokenValidateRsp $response */
    $response = $corbado->authTokens()->authTokenValidate($request);

    echo $response->getData()->getUserId();

} catch (\Corbado\Generated\ApiException $e) {
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