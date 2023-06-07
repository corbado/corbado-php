<?php

use Corbado\Configuration;
use Corbado\SDK;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $config = new Configuration();
    $config->setProjectID('pro-1')
           ->setApiSecret('apisecret')
           ->setAuthenticationURL('https://pro-1.auth.corbado.com')
           ->setJwksCachePool(new ArrayAdapter());

    $corbado = new SDK($config);
    $user = $corbado->session()->getCurrentUser();

    if ($user->isAuthenticated()) {
        echo 'User is authenticated (user ID: ' . $user->getID() . ')';
    } else {
        echo 'User is not authenticated';
    }

} catch (Throwable $e) {
    echo $e->getMessage();
    echo $e->getTraceAsString();
}
