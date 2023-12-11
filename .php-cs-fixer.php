<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->notPath('src/Generated');

$config = new PhpCsFixer\Config();
$config->setFinder($finder);

return $config;