<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use Yii;
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
        'css/bootstrap.css',


        'css/site.css',
        
        'css/theme.css?',
        'css/slick.css'

    ];
    public $js = [
        'js/jquery.js',
        'js/bootstrap.min.js',
        'js/jquery-ui.js',
        'js/newsticker.jquery.js',
        'js/jquery.slimscroll.min.js',
        'js/slick.min.js',
    ];

    public $jsOptions = array(
        //'position' => View::POS_HEAD // too high
        //'position' => View::POS_READY // in the html disappear the jquery.jrac.js declaration
        //'position' => View::POS_LOAD // disappear the jquery.jrac.js
         'position' => \yii\web\View::POS_HEAD // appear in the bottom of my page, but jquery is more down again
    );    


    public $depends = [
        
        'rmrevin\yii\fontawesome\AssetBundle',
    ];    
  /*  public $depends = [
        'yii\web\JqueryAsset',
        //'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];*/

}