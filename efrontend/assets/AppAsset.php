<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace efrontend\assets;

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
        'css/style.css',
    ];
    public $js = [
        'js/jquery.js',
		'js/popper.min.js',
        'js/bootstrap.min.js',
        'js/newsticker.jquery.js',
        //'js/jquery.rwdImageMaps.js',
		'js/jquery.maphilight.js'
    ];
    public $jsOptions = array(
        //'position' => View::POS_HEAD // too high
        //'position' => View::POS_READY // in the html disappear the jquery.jrac.js declaration
        //'position' => View::POS_LOAD // disappear the jquery.jrac.js
         'position' => \yii\web\View::POS_HEAD // appear in the bottom of my page, but jquery is more down again
    );     
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}
