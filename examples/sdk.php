<?php

use Corbado\Configuration;
use Corbado\SDK;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

require_once '../vendor/autoload.php';

try {
    $jwksCachePool = new ArrayAdapter();

    $config = new Configuration();
    $config->setProjectID('pro-1')
           ->setApiSecret('43jlk5j43lk5j34kl')
           ->setJwksCachePool($jwksCachePool);

    $sdk = new SDK($config);
    $valid = $sdk->shortSession()->validate('fldkjgflkdgfdjkl');
    $valid = $sdk->shortSession()->validate('fldkjgflkdgfdjkl');
    $valid = $sdk->shortSession()->validate('fldkjgflkdgfdjkl');

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
