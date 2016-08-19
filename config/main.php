<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-article',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'article\controllers',
    'components' => [
//        'response' => [
//            'formatters' => [
//                'encode' => 'common\components\EncodeFormatter',
//            ],
//        ],
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
            'rules' => [
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'article'],
                    ['class' => 'yii\rest\UrlRule', 'controller' => 'news'],
                    'GET,HEAD articles/<sid>' => 'article/view',
            ],
        ],
    ],
    'params' => $params,
];
