<?php

namespace app\assets;

use yii\web\AssetBundle;

class SiteAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css',
        'http://gregfranko.com/jquery.selectBoxIt.js/css/jquery.selectBoxIt.css',
        'css/style.min.css',
    ];
    public $js = [
        'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js',
        'js/scripts.min.js',
		'js/callback.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
