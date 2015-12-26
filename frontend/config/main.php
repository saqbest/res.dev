<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'suffix' => '.html',
            'rules' => [
                '' => 'site/index',
                //'<action>'=>'site/<action>',
              //  [ 'pattern' => 'օրինակ', 'route' => 'site/index', ],
              //  '<controller:\w+>/<slug>' => '<controller>/<action>',
               // '<controller:\w+>/<slug>' => '<controller>/update',
                //'status/update/<id:\d+>' => 'status/update',
               // '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

                '<controller:\w+>/<action:\w+>/<slug>' => '<controller>/<action>',
               // '<controller:\w+>/<slug>' => '<controller>/update',
                //'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
               // '<controller:\w+>/<slug>' => '<controller>/view',

            ],
        ],
        'assetManager' => [
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets'
        ],
        'request' => [
            'baseUrl' => ''
        ],
    ],
    'params' => $params,
];
