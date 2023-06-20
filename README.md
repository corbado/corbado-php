# Corbado PHP SDK

This SDK facilitates effortless integration of Corbado's Backend API within your PHP applications.

## Documentation

For a detailed understanding of how to use the Corbado Backend API, refer to
the [Corbado Backend API Reference](https://api.corbado.com/docs/api/)
and [Corbado API-only integration guide](https://docs.corbado.com/integrations/api-only).

## Requirements

Ensure your environment runs PHP 7.2 or higher.

## Installation

Use the following command to install the Corbado PHP SDK:

```bash
composer require corbado/php-sdk
```

## Usage

To initialize the SDK, supply it with your Corbado account's ```Project ID``` and ```API secret```. You can obtain these
parameters from the [Corbado developer panel](https://app.corbado.com).

## Initialization

```PHP
$config = new Corbado\Configuration("<Project ID>", "<API secret>");
$corbado = new Corbado\SDK($config);
```

### Services

The Corbado SDK provides a range of services including:

- `AuthToken`
- `EmailLinks`
- `Session`
- `SMSCodes`
- `Validation`
- `WebAuthn`
- `Widget`

- `UserApi`

To use a specific service, such as Session, invoke it as shown below:

```PHP
$corbado->session->getCurrentUser();
```

### Corbado session management

Corbado offers an efficient and secure session management system (refer to
the [documentation](https://docs.corbado.com/overview/welcome) for more details).

To validate a user after authentication, call `getCurrentUser()` which returns a user object with
all information about the current user. This object contains the current authentication state as well as user's id,
name, email and phone number.

```PHP
$user = $corbado->session->getCurrentUser();
if ($user->isAuthenticated()) {
    // Do anything with authenticated user
} else {
    // Perform login ceremony
}
```
