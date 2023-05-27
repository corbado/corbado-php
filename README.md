# Corbado PHP SDK

This is the official PHP SDK for the Corbado Platform.

## Installation

You can install the SDK via composer:

```bash
composer require corbado/corbado-php
```

## Getting started

Please follow steps 1-3 on our [Getting started](https://docs.corbado.com/overview/getting-started) page to create and configure a project in the [developer panel](https://app.corbado.com).

You will need the project ID and API secret for the next step.

## Usage

First you need to create a new instance of the Corbado client:

```php
$config = new Corbado\Configuration();
$config->setProjectID('<Your project ID obtained above>')
       ->setApiSecret('<Your API secret obtained above>');

$sdk = new Corbado\SDK($config);
```

