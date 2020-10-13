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
class PdcsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/themes/basic';
    public $css = [
       // 'plugins/bootstrap/css/bootstrap.min.css',
		'plugins/iCheck/skins/all.css',
		'plugins/font-awesome/css/font-awesome.min.css',
		'fonts/style.css',
        'plugins/jquery-ui/jquery-ui-1.10.1.custom.css',
        'plugins/toastr/toastr.min.css',
		'plugins/perfect-scrollbar/src/perfect-scrollbar.css',
		'plugins/summernote/dist/summernote.css',
		'css/custom_menus.css',
		'plugins/select2/dist/css/select2.css',
		'plugins/datepicker/css/datepicker.css',
		'plugins/toastr/toastr.min.css',
		'plugins/sweatalert/css/sweetalert2.min.css',
		'css/theme_light.css',
		'css/style.css',
		

    ];
    public $js = [
		'plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js',
		//'plugins/bootstrap/js/bootstrap.min.js',
		'plugins/perfect-scrollbar/src/jquery.mousewheel.js',
		'plugins/perfect-scrollbar/src/perfect-scrollbar.js',
		'plugins/bootstrap-fileupload/bootstrap-fileupload.min.js',
		'plugins/iCheck/jquery.icheck.min.js',
		'plugins/summernote/dist/summernote.min.js',
		'plugins/select2/dist/js/select2.js',
		'plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
		'plugins/select2/select2.min.js',
		'plugins/toastr/toastr.js',
		'plugins/sweatalert/js/sweetalert2.min.js',
		'js/main.js',

    ];
	
	public $jsOptions = array(
		//'position' => View::POS_HEAD // too high
		//'position' => View::POS_READY // in the html disappear the jquery.jrac.js declaration
		//'position' => View::POS_LOAD // disappear the jquery.jrac.js
		 'position' => \yii\web\View::POS_HEAD // appear in the bottom of my page, but jquery is more down again
	); 	
    public $depends = [
        'yii\web\YiiAsset',
		//'yii\bootstrap\BootstrapAsset',
    ];
}
