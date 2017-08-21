<?php

namespace rklandesverband\visualcaptchark;


use Yii;

use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * @author Ian Schneider <ian.schneider@n.roteskreuz.at>
 */
class Captchark extends Widget
{

    /**
     * @var string the input name. This must be set if [[model]] and [[attribute]] are not set.
     */
    public $name;

    public $options = [];

    public $namespace = 'visualcaptcha';

    private $session = '';


    public function checkVisualCaptcha()
    {

        $captcha = new Captcha($this->session);
        $frontendData = $captcha->getFrontendData();
        $request = Yii::$app->request;

        $ret = false;
        if ($frontendData) {
//             If an image field name was submitted, try to validate it
            if ($imageAnswer = $request->bodyParams[$frontendData['imageFieldName']]) {
                if ($captcha->validateImage($imageAnswer)) {
                    $ret = true;
                }
            } else if ($audioAnswer = $request->bodyParams[$frontendData['audioFieldName']]) {
                if ($captcha->validateAudio($audioAnswer)) {
                    $ret = true;
                }
            }
        }
        return $ret;
    }

    public function init()
    {
        $this->setSession();
        parent::init();


    }

    public function run()
    {

        return $this->render('captcha');
    }

    public function setSession()
    {

        $this->session = \Yii::$app->session;

        return $this->session;

    }

    /**
     * Generate a Captcha
     * @return Response
     */
    public function start($howmany = 5)
    {
        $captcha = new Captcha($this->session);
        $captcha->generate($howmany);
        return Json::encode($captcha->getFrontEndData());
    }

    /**
     * Get an audio file
     * @param  string $type Song type (mp3/ogg)
     * @return File
     */
    public function audio($type = 'mp3')
    {
        $captcha = new Captcha($this->session);
        return $captcha->streamAudio(array(), $type);
    }

    /**
     * Get an image file
     * @param  string $index Image index
     * @return File
     */
    public function image($index)
    {

        $captcha = new Captcha($this->session);
        return $captcha->streamImage(Yii::$app->response->headers, $index, 0);
    }

}
