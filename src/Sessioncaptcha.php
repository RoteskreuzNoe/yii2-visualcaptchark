<?php

namespace rklandesverband\visualcaptchark;
use yii\web\Session;
use Yii;
/**
 * Class Session
 * @package rklandesverband\visualcaptchark
 */
class Sessioncaptcha {
    private $namespace = '';
    private $session = '';

    public function __construct( $namespace = 'visualcaptcha' ) {
        $this->namespace = $namespace;
        $this->session = \Yii::$app->session;
    }

    public function clear() {
        $this->session[ $this->namespace ] = Array();
    }

    public function getSession( $key ) {
        if ( !isset( $this->session[ $this->namespace ] ) ) {
            $this->clear();
        }

        if ( isset( $this->session[ $this->namespace ][ $key ] ) ) {
            return $this->session[ $this->namespace ][ $key ];
        }

        return null;
    }

    public function setSession( $key, $value ) {
        if ( !isset( $this->session[ $this->namespace ] ) ) {
            $this->clear();
        }

        $this->session[ $this->namespace ][ $key ] = $value;
    }
}