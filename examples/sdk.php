<?php

use Corbado\Configuration;
use Corbado\SDK;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $config = new Configuration();
    $config->setProjectID('pro-1')
           ->setApiSecret('43jlk5j43lk5j34kl')
           ->setAuthenticationURL('https://pro-1.auth.corbado.com')
           ->setJwksCachePool(new ArrayAdapter());

    $sdk = new SDK($config);
    $user = $sdk->getUser();

    if ($user->isAuthenticated()) {
        echo 'User is authenticated (user ID: ' . $user->getUserID() . ')';
    } else {
        echo 'User is not authenticated';
    }

} catch (Throwable $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
}
