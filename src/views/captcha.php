<?php
/**
 * Created by PhpStorm.
 * User: n6259
 * Date: 03.08.2017
 * Time: 07:43
 */
$asset = rklandesverband\visualcaptchark\CaptcharkAsset::register($this);
use yii\web\View;
?>
<?php
$this->registerJs(<<<JS
       
        ( function (window, $) {
    $(function () {
        var captchaEl = $('#sample-captcha').visualCaptcha({
            imgPath: '$asset->baseUrl/',
            supportsAudio : false,
            language: {
                    accessibilityAlt: 'Ton - Bild',
                    accessibilityTitle: 'Barierefrei option: hören Sie sich eine Frage an und beantworten Sie diese!',
                    accessibilityDescription: 'Geben Sie undten die  <strong>antwort</strong> zu dem ein was Sie hören. Zahlen und Buchstaben:',
                    explanation: 'Bitte klicke auf <strong>ANSWER</strong>, um dich einzuloggen.',
                    refreshAlt: 'Refresh/reload icon',
                    refreshTitle: 'Refresh/reload: Neue Bilder!'
                } ,
            captcha: {
                routes: {
                    start: '/visualcaptcha/start',
                    image: '/visualcaptcha/image',
                    audio: '/visualcaptcha/audio'
                },
                numberOfImages: 8,
                callbacks: {
                    loaded: function (captcha) {
                        $('#sample-captcha a').on('click', function (event) {
                            event.preventDefault();

                            if ($(this)[0].parentElement.parentElement.classList[0] == "visualCaptcha-possibilities")
                            {
                                // console.log($(this).children('img').data('index'));
                                setTimeout(function () {
                                    $("#loginButton").attr("disabled", false);
                                    $("#loginButton").trigger("click");
                                }, 150);
                            }
                        });
                    }
                }

            }
        });
        var captcha = captchaEl.data('captcha');

        // Show an alert saying if visualCaptcha is filled or not
        var _sayIsVisualCaptchaFilled = function (event) {
            event.preventDefault();

            if (captcha.getCaptchaData().valid) {
                window.alert('visualCaptcha is filled!');
            } else {
                window.alert('visualCaptcha is NOT filled!');
            }
        };

        var statusEl = $('#status-message'),
            queryString = window.location.search;
        // Show success/error messages
        if (queryString.indexOf('status=noCaptcha') !== -1) {
            statusEl.html('<div class="status"> <div class="icon-no"></div> <p>visualCaptcha was not started!</p> </div>');
        } else if (queryString.indexOf('status=validImage') !== -1) {
            statusEl.html('<div class="status valid"> <div class="icon-yes"></div> <p>Image was valid!</p> </div>');
        } else if (queryString.indexOf('status=failedImage') !== -1) {
            statusEl.html('<div class="status"> <div class="icon-no"></div> <p>Image was NOT valid!</p> </div>');
        } else if (queryString.indexOf('status=validAudio') !== -1) {
            statusEl.html('<div class="status valid"> <div class="icon-yes"></div> <p>Accessibility answer was valid!</p> </div>');
        } else if (queryString.indexOf('status=failedAudio') !== -1) {
            statusEl.html('<div class="status"> <div class="icon-no"></div> <p>Accessibility answer was NOT valid!</p> </div>');
        } else if (queryString.indexOf('status=failedPost') !== -1) {
            statusEl.html('<div class="status"> <div class="icon-no"></div> <p>No visualCaptcha answer was given!</p> </div>');
        }

        // Bind that function to the appropriate link
        $('#check-is-filled').on('click.app', _sayIsVisualCaptchaFilled);
    });
}(window, jQuery) );
  
JS
    , View::POS_END) ?>

<div class="col-sm-14 col-md-14 col-lg-14 col-md-offset-1">
    <div class="form-group">
        <div id="status-message"></div>
        <div id="sample-captcha"></div>
    </div>
</div>
