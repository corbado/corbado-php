<?php

use Corbado\Webhook\Classes\Models\AuthMethodsDataResponse;
use Corbado\Webhook\Webhook;

require_once '../vendor/autoload.php';

try {
    // Create new webhook instance with "webhookUsername" and "webhookPassword". Both must be
    // set in the developer panel (https://app.corbado.com) and are used to secure your
    // webhook (this one here) with basic authentication.
    $webhook = new Webhook('webhookUsername', 'webhookPassword');

    // Handle authentication so your webhook is secured (basic authentication). If username
    // and/or password are invalid handleAuthentication() will send HTTP status code
    // 401 (Unauthorized) and terminate/exit execution here.
    $webhook->handleAuthentication();

    // Check if request has been made with POST. For Corbado webhooks
    // only POST is allowed/used.
    if (!$webhook->isPost()) {
        throw new Exception('Only POST is allowed');
    }

    // Get the webhook action and act accordingly. Every Corbado
    // webhook has an action.
    switch ($webhook->getAction()) {
        // Handle the "authMethods" action which basically checks
        // if a user exists on your side/in your database.
        case $webhook::ACTION_AUTH_METHODS:
            $request = $webhook->getAuthMethodsRequest();

            // Now check if the given user/username exists in your
            // database and send status. Implement getUserStatus()
            // function below.
            $status = getUserStatus($request->data->username);
            $webhook->sendAuthMethodsResponse($status);

            break;

        // Handle the "passwordVerify" action which basically checks
        // if the given username and password are valid.
        case $webhook::ACTION_PASSWORD_VERIFY:
            $request = $webhook->getPasswordVerifyRequest();

            // Now check if the given username and password is
            // valid. Implement verifyPassword() function below.
            if (verifyPassword($request->data->username, $request->data->password) === true) {
                $webhook->sendPasswordVerifyResponse(true);
            } else {
                $webhook->sendPasswordVerifyResponse(false);
            }

            break;

        default:
            throw new Exception('Invalid action "' . $webhook->getAction() . '"');
    }
} catch (Throwable $e) {
    // If something went wrong just return HTTP status
    // code 500. For successful requests Corbado always
    // expects HTTP status code 200. Everything else
    // will be treated as error.
    http_response_code(500);

    // We expose the full error message here. Usually you would
    // not do this (security!) but in this case Corbado is the
    // only consumer of your webhook. The error message gets
    // logged at Corbado and helps you and us debugging your
    // webhook.
    echo $e->getMessage();
    echo $e->getTraceAsString();
}

/**
 * Checks if user exists on your side/in your database.
 *
 * !!! MUST BE IMPLEMENTED BY YOU !!!
 *
 * @param string $username
 * @return string
 */
function getUserStatus(string $username) : string {
    /////////////////////////////////////
    // Implement your logic here!
    ////////////////////////////////////

    // Example
    if ($username == 'existing@existing.com') {
        return AuthMethodsDataResponse::USER_EXISTS;
    }

    return AuthMethodsDataResponse::USER_NOT_EXISTS;
}

/**
 * Verify given username and password.
 *
 * !!! MUST BE IMPLEMENTED BY YOU !!!
 *
 * @param string $username
 * @param string $password
 * @return bool
 */
function verifyPassword(string $username, string $password) : bool {
    /////////////////////////////////////
    // Implement your logic here!
    ////////////////////////////////////

    // Example
    if ($username == 'existing@existing.com' && $password == 'supersecret') {
        return true;
    }

    return false;
}