<?php

use Corbado\Classes\Exceptions\ServerException;
use Corbado\Configuration;
use Corbado\Generated\Model\ValidateEmailReq;
use Corbado\SDK;

require_once __DIR__ . '/../vendor/autoload.php';

$config = new Configuration('pro-3813112311613555974', 'corbado1_VMaivnYigrGfZnlvBekASbNEk357JC');
$corbado = new SDK($config);

try {
    $request = new ValidateEmailReq();
    $request->setEmail('s@s.de');
    $request->setClientInfo(SDK::createClientInfo('127.0.0.1', 'PHP CLI'));

    $response = $corbado->validations()->validateEmail($request);

    echo $response->getData()->getIsValid() ? 'Valid' : 'Invalid';

} catch (ServerException $e) {
    print_r($e->getMessage());
    print_r($e->getRuntime());
    print_r($e->getError());
} catch (Throwable $e) {
    echo 'Throwable:' . $e->getMessage();
}
