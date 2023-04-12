<?php

use Corbado\Configuration;
use Corbado\SDK;

require_once '../vendor/autoload.php';

try {
    $config = new Configuration();
    $config->setProjectID('pro-1')
        ->setApiSecret('43jlk5j43lk5j34kl');

    $sdk = new SDK($config);
    $shortSession = $sdk->shortSession();

} catch (Throwable $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
}