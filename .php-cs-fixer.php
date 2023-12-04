<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['vendor', 'src/Generated'])
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
$config->setFinder($finder);

return $config;