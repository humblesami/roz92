<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
       /* 'themes/basic/css/style.css',
        'themes/basic/css/theme_light.css',
        'css/custom_menus.css',*/

    ];
/*    public $js = [
        'themes/basic/js/main.js'
    ];*/

    public $jsOptions = array(
        //'position' => View::POS_HEAD // too high
        //'position' => View::POS_READY // in the html disappear the jquery.jrac.js declaration
        //'position' => View::POS_LOAD // disappear the jquery.jrac.js
         'position' => \yii\web\View::POS_HEAD // appear in the bottom of my page, but jquery is more down again
    );  
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
