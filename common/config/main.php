<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'MMM d, yyyy hh:mm a',
            'decimalSeparator' => '.',
            'thousandSeparator' => ', ',
            'currencyCode' => 'KSH',
        ],
    ],
];
