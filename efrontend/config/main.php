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
    'modules' => [
		'allowedIPs' => ['127.0.0.1','10.10.10.86', '::1']	,
		'catalog' => [
            'class' => 'efrontend\modules\catalog\catalog',
        ],	
	],
    'controllerNamespace' => 'efrontend\controllers',
    'components' => [
            'urlManagerFrontEnd' => [
                'class' => 'yii\web\urlManager',
                'baseUrl' => '/frontend/web/index.php',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
            ],
 'cache' => [
     'class' => 'yii\caching\DummyCache',//'class' => 'yii\caching\FileCache',
            //'class' => 'yii\redis\Cache',
          ], 
            'assetManager' => [
                    'bundles' => [
                        'yii\web\JqueryAsset' => [
                            'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
                        ],
                    ],
                ],
        
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
			'showScriptName' => true,
			'rules' => [
				'' => 'site/index',
				'<action>'=>'site/<action>',
			],
		],
    ],
    'params' => $params,
];
