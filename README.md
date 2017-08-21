
Visualcpatchark
=============

Features
------------
Visual Captcha  RK 
It uses emotionloop/visualcaptcha


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist rklandesverband/yii2-visualcaptchark "*"
```

or add

```
"rklandesverband/yii2-visualcaptchark": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?php 
    use rklandesverband\visualcaptchark\Captchark;
?>
 <?php echo Captchark::widget(); ?>```
 
 Add a Controller 
 
 ```php
 <?php
 use rklandesverband\visualcaptchark\Sessioncaptcha;
 use yii\helpers\Url;
 use yii\web\Controller;
 use yii\helpers\Json;
 use Yii;
 
 class VisualcaptchaController extends Controller
 {
 
     public function actionStart($howmany = 5)
     {
         $captcha = new Captchark();
         return $captcha->start($howmany);
     }
 
     public function actionImage($index)
     {
         $captcha = new Captchark();
         return $captcha->image($index);
     }
 
     public function actionAudio()
     {
         $captcha = new Captchark();
         return $captcha->audio();
     }
 
     public function  actionCaptcha(){
         $captcha = new Captchark();
         return $captcha->checkVisualCaptcha();
     }
 }
 
 ```
 
 In the main.php add rules
 ```php
    'passwort/visualcaptcha/start/<howmany:\d+>' => 'passwort/visualcaptcha/start',
    'passwort/visualcaptcha/image/<index:\d+>' => 'passwort/visualcaptcha/image',
    'passwort/visualcaptcha/audio/' => 'passwort/visualcaptcha/audio',
    'passwort/visualcaptcha/captcha' => 'passwort/visualcaptcha/captcha',
    'passwort/passwort/visualcaptcha/start/<howmany:\d+>' => 'passwort/visualcaptcha/start',
    'passwort/passwort/visualcaptcha/image/<index:\d+>' => 'passwort/visualcaptcha/image',
    'passwort/passwort/visualcaptcha/audio/' => 'passwort/visualcaptcha/audio',
    'passwort/passwort/visualcaptcha/captcha' => 'passwort/visualcaptcha/captcha',
 ```
=======
# yii2-visualcaptchark
Visualcpatchark LV NOE
