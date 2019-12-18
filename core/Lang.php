<?php

use core\Router;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of language
 *
 * @author user
 */
class Lang {

    public static $lang;
    public static $array_consts;

    //Установка языка, чтобы можно было использовать Lang::_(), например из CRON'а или при получении Callback-ов от LiqPay
    public static function setLang($lang) {
        self::$lang = $lang;
        return true;
    }

    public static function initialiseLang() {
        /*if (isset($_COOKIE['lang'])) {
            self::$lang = $_COOKIE['lang'];
        } else {
            self::$lang = DEFAULT_LANGUAGE;
        }*/
        if (empty(self::$lang)) {
            $route = Router::getRoute();
            self::$lang = !empty($route['lang']) ? $route['lang'] : DEFAULT_LANGUAGE;
        }
        return self::$lang;
    }

    //returns array of translations of current language for PHP
    public static function getTranslationLines() {
        self::initialiseLang();

        if (isset(self::$array_consts)) {
            return self::$array_consts;
        }

        if (file_exists(DATA_DIR . DS . 'languages' . DS . self::$lang . '.php')) {
            $file = DATA_DIR . DS . 'languages' . DS . self::$lang . '.php';
        } else {
            $file = DATA_DIR . DS . 'languages' . DS . DEFAULT_LANGUAGE . '.php';
        }
        self::$array_consts = include $file;
        return self::$array_consts;
    }

    //Returns JS array from file of translations for Lang._() - JS-analogue of PHP Lang::_()
    public static function echoLanguageArrayForJs() {
        if (!self::$lang) {
            self::initialiseLang();
        }
        if (file_exists(DATA_DIR . DS . 'languages' . DS . 'js' . DS . self::$lang . '.js')) {
            $file = DATA_DIR . DS . 'languages' . DS . 'js' . DS . self::$lang . '.js';
        } else {
            $file = DATA_DIR . DS . 'languages' . DS . 'js' . DS . DEFAULT_LANGUAGE . '.js';
        }
        $content = file_get_contents($file);
        return $content;
    }

    public static function getLanguages() {
        $files = scandir(DATA_DIR . DS . 'languages' . DS);
        $languages = [];
        foreach ($files as $value) {
            if (preg_match('#.php#i', $value)) {
                $lang = preg_replace('#.php#i', '', $value);
                //$languages[$lang]['full'] = $lang;
                //$languages[$lang]['short'] = explode('_', $lang)[0];
                $languages[$lang]['name'] = $lang;
            }
        }
        return $languages;
    }

    //Main translation method
    public static function _($subject) {
        $lines = self::getTranslationLines();
        if (!isset($lines[$subject])) {
            return $subject;
        } else {
            return $lines[$subject];
        }
    }

    public static function shortCode($lang = false) {
        if ($lang === false) {
            $lang = self::initialiseLang();
        }
        return explode('_', $lang)[0];
    }

    public static function setLanguage($lang) {
        $_COOKIE['lang'] = $lang;
        setcookie("lang", $lang, time() + (5 * 365 * 24 * 60 * 60), '/');
    }

    //Returns current LangCode for URL in templates. For example if DEFAULT lang is en_GB we do not need to return "en", we return "", but if CURRENT lang is ru_RU we return "ru"
    public static function code() {
        if (self::initialiseLang() != DEFAULT_LANGUAGE) {
            $LangCode = self::shortCode(self::initialiseLang());
        } else {
            $LangCode = "";
        }
        return $LangCode;
    }

    //returns URL with current lang code (except DEFAULT_LANGUAGE).
    public static function url($url = "") {
        /*if (isset($_COOKIE['lang']) && ($_COOKIE['lang'] != DEFAULT_LANGUAGE)) {
            return "/" . self::code() . "/" . $url; // for example "/ru/blah-blah-blah"
        } else {
            return "/" . $url; // for example "/blah-blah-blah"
        }*/
        $lang = self::initialiseLang();
        return $lang != DEFAULT_LANGUAGE ? "/" . $lang . "/" . $url : "/" . $url;
    }

}
