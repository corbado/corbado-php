<?php

// Run development server with "CORBADO_PROJECT_ID=<Project ID> CORBADO_API_SECRET=<API secret> php -S localhost:3000" and
// open http://localhost:3000/authTokens.php?corbadoAuthToken=<Auth token> in your browser

require_once __DIR__ . '/../vendor/autoload.php';

$config = Corbado\Config::fromEnv();
$sdk = new Corbado\SDK($config);

try {
    $corbadoAuthToken = $_GET['corbadoAuthToken'] ?? '';
    $remoteAddress = $_SERVER['REMOTE_ADDR'] ?? '';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

    $request = new Corbado\Generated\Model\AuthTokenValidateReq();
    $request->setToken($corbadoAuthToken);
    $request->setClientInfo(Corbado\SDK::createClientInfo($remoteAddress, $userAgent));

    // Returns $response on valid auth token, throws exception on invalid auth token
    $response = $sdk->authTokens()->validate($request);

    echo $response->getData()->getUserId();

} catch (Throwable $e) {
    // Handle exception (see https://github.com/corbado/corbado-php?tab=readme-ov-file#error-handling for more details)
    echo $e->getMessage();
}
