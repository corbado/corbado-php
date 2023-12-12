# Corbado PHP SDK

PHP SDK for Corbado Backend API

[![Test Status](https://github.com/corbado/corbado-php/workflows/build/badge.svg)](https://github.com/corbado/corbado-php/actions?query=workflow%3Abuild)
[![documentation](https://img.shields.io/badge/documentation-Corbado_Backend_API_Reference-blue.svg)](https://api.corbado.com/docs/api/)
[![License](https://poser.pugx.org/corbado/php-sdk/license.svg)](https://packagist.org/packages/corbado/corbado-php)
[![Latest Stable Version](http://poser.pugx.org/corbado/php-sdk/v)](https://packagist.org/packages/corbado/php-sdk)

## Requirements

The SDK supports PHP Version 7.2 and above.

## Usage

Use the following command to install the Corbado PHP SDK:

```bash
composer require corbado/php-sdk
```

Now create a new SDK client:

```PHP
$config = new Corbado\Configuration("<Project ID>", "<API secret>");
$corbado = new Corbado\SDK($config);
```

## Services

The Corbado SDK provides a range of services including:

- `AuthTokens`
- `EmailLinks`
- `Sessions`
- `SMSCodes`
- `Validation`
- `Users`

To use a specific service, such as Session, invoke it as shown below:

```PHP
$corbado->sessions()->getCurrentUser();
```

## Corbado session management

Corbado offers an efficient and secure session management system (refer to
the [documentation](https://docs.corbado.com/sessions/overview) for more details).

To validate a user after authentication, call `getCurrentUser()` which returns a user object with
all information about the current user. This object contains the current authentication state as well as user's id,
name, email and phone number.

```PHP
$user = $corbado->sessions()->getCurrentUser();
if ($user->isAuthenticated()) {
    // Do anything with authenticated user
} else {
    // Perform login ceremony
}
```
