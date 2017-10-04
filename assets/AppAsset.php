<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

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
    ];
    public $js = [
        //js переопределяющий yii.confirm
        'js/yii.confirm.overrides.js',

//        'js/typeahead.bundle.js',
//        'js/typeahead.jquery.js',
//        'js/test.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        //импорт файлов SweetAlertAsset
        //импорт файлов BootboxAsset
        'app\assets\BootboxAsset',
    ];
}
