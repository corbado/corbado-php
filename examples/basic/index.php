<?php

// Autoloader
require_once '../../vendor/autoload.php';
require_once 'vendor/autoload.php';

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

// Set short-term session value (just use the Corbado Preview of a project, signup and login there
// and then copy the short-term session value (represented as JWT) from the "cbo_short_session" cookie).
$shortTermSession = '<Your short-term session value>';
