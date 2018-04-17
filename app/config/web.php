<?php

require(__DIR__ . '/../models/RootCategory.php');
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'i-otGlhqCXkLKYQAKWX7tfm_lS3xYwui',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'judemin1989@gmail.com',
                'password' => 'jomolungma',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'logout' => 'site/logout',
                'katalog' => 'site/catalog',
                'product' => 'site/product-view',
                'o-kompanii' => 'site/about',
                'kontakty' => 'site/contacts',
                'produkty-po-tegam' => 'site/product-by-tag',
				'send-email' => 'site/send-email',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_FLOOR_COVERINGS) . '/<id:\d+>' => 'site/category',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_FLOOR_COVERINGS) . '/<url:[0-9a-zA-Z-_]+>' => 'site/category',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_MUDGUARDS) . '/<id:\d+>' => 'site/category',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_MUDGUARDS) . '/<url:[0-9a-zA-Z-_]+>' => 'site/category',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_LED_LIGHTING) . '/<id:\d+>' => 'site/catalog',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_LED_LIGHTING) . '/<url:[0-9a-zA-Z-_]+>' => 'site/category',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_EKOTEHNIKA) . '/<id:\d+>' => 'site/category',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_EKOTEHNIKA) . '/<url:[0-9a-zA-Z-_]+>' => 'site/category',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) . '/<id:\d+>' => 'site/category',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) . '/<url:[0-9a-zA-Z-_]+>' => 'site/category',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_FLOOR_COVERINGS) . '/<category_id:\d+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_FLOOR_COVERINGS) . '/<category_id:\d+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_FLOOR_COVERINGS) . '/<category_url:[0-9a-zA-Z-_]+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_FLOOR_COVERINGS) . '/<category_url:[0-9a-zA-Z-_]+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_MUDGUARDS) . '/<category_id:\d+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_MUDGUARDS) . '/<category_id:\d+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_MUDGUARDS) . '/<category_url:[0-9a-zA-Z-_]+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_MUDGUARDS) . '/<category_url:[0-9a-zA-Z-_]+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_LED_LIGHTING) . '/<category_id:\d+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_LED_LIGHTING) . '/<category_id:\d+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_LED_LIGHTING) . '/<category_url:[0-9a-zA-Z-_]+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_LED_LIGHTING) . '/<category_url:[0-9a-zA-Z-_]+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_EKOTEHNIKA) . '/<category_id:\d+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_EKOTEHNIKA) . '/<category_id:\d+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_EKOTEHNIKA) . '/<category_url:[0-9a-zA-Z-_]+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_EKOTEHNIKA) . '/<category_url:[0-9a-zA-Z-_]+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',

                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) . '/<category_id:\d+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) . '/<category_id:\d+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) . '/<category_url:[0-9a-zA-Z-_]+>/<product_id:\d+>' => 'site/product',
                \app\models\RootCategory::getRootCategoryUrl(\app\models\RootCategory::CATEGORY_ACCESSIBLE_ENVIRONMENT) . '/<category_url:[0-9a-zA-Z-_]+>/<product_url:[0-9a-zA-Z-_]+>' => 'site/product',

                'search/<search:>' => 'site/search',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
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
