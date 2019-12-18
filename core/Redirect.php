<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;
/**
 * Description of Redirect
 *
 * @author user
 */
class Redirect {

    public static $redirects = [];

    public static function _($url, $code = null, $msg = null) {
        if (isset($code)) {
            http_response_code($code);
        }
        $url = url($url);
        header("Location: $url");
        if ($msg === null) {
            $msg = \Lang::_("REDIRECTING");
        }
        die($msg);
    }

    public static function _301($url, $msg = null) {
        http_response_code(301);
        $url = url($url);
        header("Location: $url");
        if ($msg === null) {
            $msg = \Lang::_("REDIRECTING");
        } else {
            Message::setMessage($msg);
        }
        die($msg);
    }

    //Редиректит на предыдущую страницу
    public static function _Back($msg = null, $time = 0) {
        if (!isset($_SERVER["HTTP_REFERER"])) {
            self::_301("/");
        }
        header('Refresh: ' . $time . '; url=' . $_SERVER['HTTP_REFERER']);
        if ($msg === null) {
            $msg = \Lang::_("REDIRECTING");
        }
        die($msg);
    }

    public static function globalReirectMethod($url, $layout = 'frontend') {
        self::setRedirects($layout);
        foreach (self::$redirects as $key => $value) {
            if (preg_match("#$key#i", $url, $matches)) {
                if (isset($matches[$value])) {
                    self::_('/' . $matches[$value]);
                } elseif ($key == $url) {
                    self::_($value);
                }
            }
        }
    }

    public static function setRedirects($layout) {
        if (empty(self::$redirects)) {
            self::$redirects = require_once DATA_DIR . DS . 'redirects' . DS . $layout . '.php';
        }
    }

}
