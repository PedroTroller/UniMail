<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->in(__DIR__)
    ->exclude('spec')
    ->exclude('vendor')
;

return Symfony\CS\Config\Config::create()
    ->setUsingCache(true)
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers([
        'align_double_arrow',
        'align_equals',
        'concat_with_spaces',
        'logical_not_operators_with_spaces',
        'newline_after_open_tag',
        'ordered_use',
        'phpdoc_order',
    ])
    ->finder($finder)
;
