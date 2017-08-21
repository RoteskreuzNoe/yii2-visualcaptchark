<?php

namespace rklandesverband\visualcaptchark;


use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Ian Schneider <ian.schneider@n.roteskreuz.at>
 */
class CaptcharkAsset extends AssetBundle
{
    public $sourcePath = '@rklandesverband/visualcaptchark/assets';
    public $baseUrl = '@web/images';
    public $jsOptions = ['position' => View::POS_END];
    public $css = [
        'visualcaptcha.css',
    ];
    public $js = [
        'visualcaptcha.jquery.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
