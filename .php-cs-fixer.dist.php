<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('vendor');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        '@PHP74Migration:risky' => true,
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
    ;
