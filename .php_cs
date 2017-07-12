<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('vendor');
return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => array('syntax' => 'short'),
    ])
    ->setFinder($finder);
