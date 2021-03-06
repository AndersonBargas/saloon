<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/fontawesome-all.css',
        'css/switchery.css',
        'css/bootstrap-datetimepicker.min.css',
    ];
    public $js = [
        'js/switchery.js',
        'js/bootbox.min.js',
        'js/moment-with-locales.js',
        'js/bootstrap-datetimepicker.min.js',
        'js/loadingoverlay.min.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
