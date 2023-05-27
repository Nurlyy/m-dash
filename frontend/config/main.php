<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    // 'language' => 'ru',
    'defaultRoute' => 'main/index',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/translations',
                ],
            ],
        ],
        'urlManager' => [
            // 'class' => 'cetver\LanguageUrlManager\UrlManager',
            // 'languages' => ['en', 'ru', 'kz'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'scriptUrl' => '/index.php',
            'baseUrl' => '/',
            //'suffix' => '.html',
            'rules' => [
                '' => 'main/index',
                '<action>' => 'main/index',
                'manage/<action>' => 'manage/<action>',
                'main/<action>' => 'main/<action>',
                'site/<action>' => 'site/<action>',
                '<controller>/<action>' => 'site/error',
            ],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '219169803119-tjblsl80rgsit6g8jhh29h3660jm844a.apps.googleusercontent.com',
                    'clientSecret' => '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',
                ],
            ],
        ],
    ],
    'params' => $params,
];
