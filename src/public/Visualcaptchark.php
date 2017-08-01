<?php

namespace rklandesverband\visualcaptchark;
 

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Object;

/**
 * @author Ian Schneider <ian.schneider@n.roteskreuz.at>
 */
class Visualcaptchark extends Object
{


    public function _run()
    {
        die('asdf');
        parent::run();

        return $this->render('cropper', [
            'cropperOptions' => $this->cropperOptions,
            'inputOptions' => $this->inputOptions,
        ]);
    }











}
