![corbado-php](https://github.com/corbado/corbado-php/assets/18458907/aa4f9df6-980b-4b24-bb2f-d71c0f480971)

# Corbado PHP SDK

[![License](https://poser.pugx.org/corbado/php-sdk/license.svg)](https://packagist.org/packages/corbado/php-sdk)
[![Latest Stable Version](http://poser.pugx.org/corbado/php-sdk/v)](https://packagist.org/packages/corbado/php-sdk)
[![Test Status](https://github.com/corbado/corbado-php/workflows/tests/badge.svg)](https://github.com/corbado/corbado-php/actions?query=workflow%3Atests)
[![documentation](https://img.shields.io/badge/documentation-Corbado_Backend_API_Reference-blue.svg)](https://apireference.cloud.corbado.io/backendapi-v2/)
[![Slack](https://img.shields.io/badge/slack-join%20chat-brightgreen.svg)](https://join.slack.com/t/corbado/shared_invite/zt-1b7867yz8-V~Xr~ngmSGbt7IA~g16ZsQ)

The [Corbado](https://www.corbado.com) PHP SDK provides convenient access to the [Corbado Backend API](https://apireference.cloud.corbado.io/backendapi-v2/) from applications written in the PHP language.

:warning: The Corbado PHP SDK is commonly referred to as a private client, specifically designed for usage within closed backend applications. This particular SDK should exclusively be utilized in such environments, as it is crucial to ensure that the API secret remains strictly confidential and is never shared.

:rocket: [Getting started](#rocket-getting-started) | :hammer_and_wrench: [Services](#hammer_and_wrench-services) | :books: [Advanced](#books-advanced) | :speech_balloon: [Support & Feedback](#speech_balloon-support--feedback)

## :rocket: Getting started

### Requirements

- PHP 8.0 or later
- [Composer](https://getcomposer.org/)

### Installation

Use the following command to install the Corbado PHP SDK:

```bash
composer require corbado/php-sdk
```

### Usage

To create a Corbado PHP SDK instance you need to provide your `Project ID`, `API secret`, `Frontend API URL` and `Backend API URL` which can be found at the [Developer Panel](https://app.corbado.com).

```PHP
$config = new Corbado\Config('<Project ID>', '<API secret>', '<Frontend API URL>', '<Backend API URL>');
$sdk = new Corbado\SDK($config);
```

### See in action

[![integration-guides]([assets/integration_guides.png](https://github.com/user-attachments/assets/7859201b-a345-4b68-b336-6e2edcc6577b))](https://app.corbado.com/getting-started?search=php)

- Check the [PHP Laravel](https://github.com/corbado/passkeys-php-laravel) example
- Check the integration tests [here](tests/integration)

## :hammer_and_wrench: Services

The Corbado PHP SDK provides the following services:

- `sessions` for managing sessions
- `users` for managing users ([examples](tests/integration/User))
- `identifiers` for managing identifiers ([examples](tests/integration/Identifier))

To use a specific service, such as `sessions`, invoke it as shown below:

```PHP
$user = $sdk->sessions()->getCurrentUser();
``` 

## :books: Advanced

### Error handling

The Corbado PHP SDK throws exceptions for all errors. The following exceptions are thrown:

- `AssertException` for failed assertions (client side)
- `ConfigException` for configuration errors (client side)
- `ValidationException` for validation errors (client side)
- `ServerException` for server errors (server side)
- `StandardException` for everything else (client side)

If the Backend API returns an HTTP status code other than 200, the Corbado PHP SDK throws a `ServerException`. The `ServerException`class provides convenient methods to access all important data:

```PHP
try {
    // Try to get non-existing user with ID 'usr-123456789'
    $user = $sdk->users()->get('usr-123456789');
} catch (ServerException $e) {
    // Show HTTP status code (400 in this case)
    echo $e->getHttpStatusCode() . PHP_EOL;
    
    // Show request ID (can be used in developer panel to look up the full request
    // and response, see https://app.corbado.com/app/logs/requests)
    echo $e->getRequestID() . PHP_EOL;
    
    // Show full request data
    var_dump($e->getRequestData());
    
    // Show runtime of request in seconds (server side)
    echo $e->getRuntime() . PHP_EOL;
    /Users/stefan.becker/Projects/Corbado/sdks/corbado-php/assets/integration_guides.png
    // Show validation error messages (server side validation in case of HTTP
    // status code 400 (Bad Request))
    var_dump($e->getValidationMessages());
    
    // Show full error data
    var_dump($e->getError());
}
```

## :speech_balloon: Support & Feedback

### Report an issue

If you encounter any bugs or have suggestions, please [open an issue](https://github.com/corbado/corbado-php/issues/new).

### Slack channel

Join our Slack channel to discuss questions or ideas with the Corbado team and other developers.

[![Slack](https://img.shields.io/badge/slack-join%20chat-brightgreen.svg)](https://join.slack.com/t/corbado/shared_invite/zt-1b7867yz8-V~Xr~ngmSGbt7IA~g16ZsQ)

### Email

You can also reach out to us via email at vincent.delitz@corbado.com.

### Vulnerability reporting

Please report suspected security vulnerabilities in private to security@corbado.com. Please do NOT create publicly viewable issues for suspected security vulnerabilities.
