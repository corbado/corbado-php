<?php

//////////////////////////////////////////////////////////////////////////////////////////////
// Basic example which serves as basis for code snippets for integration guides             //
//////////////////////////////////////////////////////////////////////////////////////////////

require_once '../../vendor/autoload.php';
require_once 'vendor/autoload.php';

//////////////////////////////////////////////////////////////////////////////////////////////
// Instantiate SDK                                                                          //
//////////////////////////////////////////////////////////////////////////////////////////////

// Configuration
$projectID = '<Your Project ID>';
$apiSecret = '<Your API secret>';
$frontendAPI = '<Frontend API URL>';
$backendAPI = '<Backend API URL>';

// Create JWKS cache (JWKS stands for JSON Web Key Sets and contain the public keys that must
// be used to verify the signature of a JWT which we use for the short-term session).
$jwksCache = new \Symfony\Component\Cache\Adapter\FilesystemAdapter();

// Create SDK instance
$config = new \Corbado\Config($projectID, $apiSecret, $frontendAPI, $backendAPI);
$config->setJwksCachePool($jwksCache);
$sdk = new \Corbado\SDK($config);

//////////////////////////////////////////////////////////////////////////////////////////////
// Protecting routes                                                                        //
//////////////////////////////////////////////////////////////////////////////////////////////

// Retrieve the short-term session value from the Cookie ($_COOKIE['cbo_short_session']) or
// the Authorization header ($_SERVER['HTTP_AUTHORIZATION']).
$shortTermSessionValue = '<Your short-term session value>';

if ($shortTermSessionValue == '') {
    // If the short-term session value is empty (e.g. the cookie is not set or
    // expired), the user is not authenticated. Redirect to the login page.
    header('Location: /login');
    exit(0);
}

try {
    $user = $sdk->sessions()->validateToken($shortTermSessionValue);

    echo 'User with ID ' . $user->getId() . ' is authenticated!' . PHP_EOL;
} catch (\Corbado\Exceptions\ValidationException $e) {
    // Error in token validation (e.g. token is invalid or expired), see
    // https://github.com/corbado/corbado-php/blob/main/src/Exceptions/ValidationException.php
    // for a list of codes to handle them properly.

    echo $e->getMessage() . ' ' . $e->getCode() . PHP_EOL;
} catch (Throwable $e) {
    // Other errors
    echo $e->getMessage() . PHP_EOL;
}

//////////////////////////////////////////////////////////////////////////////////////////////
// Getting user data from short-term session (represented as JWT)                           //
//////////////////////////////////////////////////////////////////////////////////////////////

$user = $sdk->sessions()->validateToken($shortTermSessionValue);

echo 'User ID: ' . $user->getID() . PHP_EOL;
echo 'User full name: ' . $user->getName() . PHP_EOL;
echo 'User email: ' . $user->getEmail() . PHP_EOL;
echo 'User phone number: ' . $user->getPhoneNumber() . PHP_EOL;

//////////////////////////////////////////////////////////////////////////////////////////////
// Getting user data from Corbado Backend API                                               //
//////////////////////////////////////////////////////////////////////////////////////////////

$user = $sdk->sessions()->validateToken($shortTermSessionValue);
$fullUser = $sdk->users()->get($user->getID());

echo 'User full name: ' . $fullUser->getFullName() . PHP_EOL;
echo 'User status: ' . $fullUser->getStatus() . PHP_EOL;