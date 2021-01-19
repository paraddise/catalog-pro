<?php


namespace app\assets;


use yii\web\AssetBundle;

class CreateCatalogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        '/js/create-catalog.js'
    ];
    public $depends = [
        'app\assets\AppAsset'
    ];
}