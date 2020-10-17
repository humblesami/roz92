<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'backend',
    'homeUrl' => '/',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [


        // stie map

'sitemap' => [
        'class' => 'himiklab\sitemap\Sitemap',
        'models' => [
            // your models
            'yeesoft\post\models\Post',
        ],
        'urls'=> [
            // your additional urls
            [
                'loc' => 'https://www.roznama92news.com',
                'changefreq' => \himiklab\sitemap\behaviors\SitemapBehavior::CHANGEFREQ_DAILY,
                'priority' => 0.8,
               
              
            ],
        ],
        'enableGzip' => true, // default is false
        'cacheExpire' => 1, // 1 second. Default is 24 hours
    ],        
  'plugins' => [
        'class' => 'lo\plugins\Module',
        'pluginsDir'=>[
            '@lo/plugins/core', // default dir with core plugins
            '@lo/shortcodes', // dir with shortcodes pack
            '@common/shortcodes', // dir with our plugins with shortcodes
        ]
    ],      
        'settings' => [
            'class' => 'yeesoft\settings\SettingsModule',
        ],

        'core' => [
            'class' => 'backend\modules\core\core',
        ],        
        'paper' => [
            'class' => 'backend\modules\paper\paper',
        ],        
        'menu' => [
            'class' => 'yeesoft\menu\MenuModule',
        ],
        'translation' => [
            'class' => 'yeesoft\translation\TranslationModule',
        ],
        'user' => [
            'class' => 'yeesoft\user\UserModule',
        ],
        'media' => [
            'class' => 'yeesoft\media\MediaModule',
            'routes' => [
                'baseUrl' => '', // Base absolute path to web directory
                'basePath' => '@frontend/web', // Base web directory url
                'uploadPath' => 'uploads', // Path for uploaded files in web directory
            ],
        ],
        'post' => [
            'class' => 'yeesoft\post\PostModule',
        ],
        'columiest' => [
            'class' => 'backend\modules\columiest\PostModule',
        ],

        
        'page' => [
            'class' => 'yeesoft\page\PageModule',
        ],
        'seo' => [
            'class' => 'yeesoft\seo\SeoModule',
        ],
       

        'comment' => [
            'class' => 'yeesoft\comment\CommentModule',
        ],
    ],
    'components' => [
        'frontcache' => [
            'class' => 'yii\caching\DummyCache', //'class' => 'yii\caching\FileCache',
                   'cachePath' => Yii::getAlias('@frontend') . '/runtime/cache'
                   //'class' => 'yii\redis\Cache',
                 ], 
        'efrontcache' => [
            'class' => 'yii\caching\DummyCache',//'class' => 'yii\caching\FileCache',
                   'cachePath' => Yii::getAlias('@efrontend') . '/runtime/cache'
                   //'class' => 'yii\redis\Cache',
                 ],                
                'cache' => [
                    'class' => 'yii\caching\DummyCache',//'class' => 'yii\caching\FileCache',
                 ],
        'plugins' => [
            'class' => lo\plugins\components\PluginsManager::class,
            'appId' => 1, // lo\plugins\BasePlugin::APP_FRONTEND,
            // by default
            'enablePlugins' => true,
            'shortcodesParse' => true,
            'shortcodesIgnoreBlocks' => [
                '<pre[^>]*>' => '<\/pre>',
                //'<div class="content[^>]*>' => '<\/div>',
            ]
        ],          
    'view' => [
        'class' => lo\plugins\components\View::class,
    ],

        'request' => [
          'baseUrl' => '/manage',
       ],
        'assetManager' => [
            
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@yeesoft/yii2-yee-core/assets/theme/bootswatch/custom',
                    'css' => ['bootstrap.css']
                ],
            ],
        ],
        'urlManager' => [
            'class' => 'yeesoft\web\MultilingualUrlManager',
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'multilingualRules' => false,
            'rules' => array(
                //add here local frontend controllers
                //'<controller:(test)>' => '<controller>/index',
                //'<controller:(test)>/<id:\d+>' => '<controller>/view',
                //'<controller:(test)>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'<controller:(test)>/<action:\w+>' => '<controller>/<action>',
                //yee cms and other modules routes
                '<module:\w+>/' => '<module>/default/index',
                '<module:\w+>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
                '<module:\w+>/<action:(create)>' => '<module>/default/<action>',
                '<module:\w+>/<controller:\w+>' => '<module>/<controller>/index',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'], // site map
            )
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
    ],
    'params' => $params,
];
