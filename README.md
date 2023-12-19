<img width="1070" alt="GitHub Repo Cover" src="https://github.com/corbado/corbado-php/assets/18458907/aa4f9df6-980b-4b24-bb2f-d71c0f480971">



# Corbado PHP SDK

[![License](https://poser.pugx.org/corbado/php-sdk/license.svg)](https://packagist.org/packages/corbado/corbado-php)
[![Latest Stable Version](http://poser.pugx.org/corbado/php-sdk/v)](https://packagist.org/packages/corbado/php-sdk)
[![Test Status](https://github.com/corbado/corbado-php/actions/workflows/build.yml/badge.svg)](https://github.com/corbado/corbado-php/actions)
[![documentation](https://img.shields.io/badge/documentation-Corbado_Backend_API_Reference-blue.svg)](https://api.corbado.com/docs/api/)
[![Slack](https://img.shields.io/badge/slack-join%20chat-brightgreen.svg)](https://join.slack.com/t/corbado/shared_invite/zt-1b7867yz8-V~Xr~ngmSGbt7IA~g16ZsQ)

The [Corbado](https://www.corbado.com) PHP SDK provides convenient access to the [Corbado Backend API](https://api.corbado.com/docs/api/) from applications written in the PHP language.

# :rocket: Getting started

## Requirements

- PHP 7.2 or later
- [Composer](https://getcomposer.org/)

## Installation

Use the following command to install the Corbado PHP SDK:

```bash
composer require corbado/php-sdk
```

## Usage

To create a Corbado PHP SDK instance you need to provide your `project ID` and `API secret` which can be found at the [Developer Panel](https://app.corbado.com).

```PHP
$config = new Corbado\Configuration("<Project ID>", "<API secret>");
$corbado = new Corbado\SDK($config);
```

# :books: Advanced

## Error handling

The Corbado PHP SDK throws exceptions for all errors. The following exceptions are thrown:

- `Corbado\ApiException` for any API errors
- TODO

# :speech_balloon: Support & Feedback

## Raise an issue

If you encounter any bugs or have suggestions, please [open an issue](https://github.com/corbado/corbado-php/issues/new).

## Slack channel

Join our Slack channel to discuss questions or ideas with the Corbado team and other developers.

[![Slack](https://img.shields.io/badge/slack-join%20chat-brightgreen.svg)](https://join.slack.com/t/corbado/shared_invite/zt-1b7867yz8-V~Xr~ngmSGbt7IA~g16ZsQ)

## Email

You can also reach out to us via email at vincent.delitz@corbado.com.

## Vulnerability reporting

Please report suspected security vulnerabilities in private to security@corbado.com. Please do NOT create publicly viewable issues for suspected security vulnerabilities.
