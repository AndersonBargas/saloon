<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Saloon',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'pt-BR',
    'layout' => 'main',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'JP1VZZ2ITbKSXfObedxMgm5JeRi_fF7j',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Usuarios',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'login'  => 'site/login',
                'logout' => 'site/logout',

                'historico' => 'historico/index',
                'reservas'  => 'reservas/index',
                'usuarios'  => 'usuarios/index',

                'historico/<id:\d+>' => 'historico/ver',
                'reservas/<id:\d+>'  => 'reservas/ver',
                'usuarios/<id:\d+>'  => 'usuarios/ver',

                'historico/<action:(.*)>/<id:\d+>' => 'historico/<action>',
                'reservas/<action:(.*)>/<id:\d+>'  => 'reservas/<action>',
                'salas/<action:(.*)>/<id:\d+>'     => 'salas/<action>',
                'usuarios/<action:(.*)>/<id:\d+>' => 'usuarios/<action>',

                '<controller:(.*)/<action:(.*)>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
