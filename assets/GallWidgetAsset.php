<?php


namespace alex290\widgetgallery\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GallWidgetAsset extends AssetBundle
{
    public $sourcePath = '@alex290/widgetgallery/assets/scr';
    public $css = [
        'fileinput/css/fileinput.css',
        'fileinput/themes/explorer-fas/theme.css',
        'css/jquery-ui.min.css',
        'css/main.css',
    ];
    public $js = [
        'fileinput/js/fileinput.js',
        'fileinput/js/locales/ru.js',
        'fileinput/themes/fas/theme.js',
        'fileinput/themes/explorer-fas/theme.js',
        'js/jquery-ui.min.js',
        'js/widget.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
    // public function init()
    // {
    //     parent::init();
    //     // resetting BootstrapAsset to not load own css files
    //     \Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
    //         'css' => [],
    //         'js' => []
    //     ];
    //     \Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapPluginAsset'] = [
    //         'css' => [],
    //         'js' => []
    //     ];
    // }
}
