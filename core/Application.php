<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of application
 *
 * @author user
 */

namespace core;

use application\models\data\Tables;

class Application {

    public static function getData($file) {
        $data = require_once ROOT . DS . 'data' . DS . $file . '.php';
        return $data;
    }

    public static function import_lib($path) {
        $path = str_replace('.', DS, $path);
        require_once (LIBS . DS . $path . '.php');
    }

    public static function randomString() {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $length = rand(10, 30);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $string;
    }

    public static function tidyString($str) {
        //Удаление всех тегов, кроме тех, которые можно использовать
        $str = strip_tags($str, "<br><p><ul><ol><li><bold><strong>");

        //Удаление всех атрибутов из тегов
        $str = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i", '<$1$2>', $str);

        //Заменяем все html-сущности специальными символами. Не нужно, это делается в моделях там, где необходимо.
//        $str = htmlspecialchars($str);
        return $str;
    }

    public static function hashcheck($val, $hash = null) {
        if ($hash == null) {
            $hash = password_hash($val, PASSWORD_DEFAULT);
            return $hash;
        } else {
            return password_verify($val, $hash);
        }
    }

    public static function email_validate($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function removeQueryFromUrl($url, $only_host = false) {
        $parsed_url = parse_url($url);
        if ($only_host) {
            return $parsed_url['host'];
        }
        $domain = $parsed_url['scheme'] . '://' . $parsed_url['host'];
        return $domain;
    }

    public static function getUniqueAccessTocken()
    {

        $accessToken = self::randomString();
        $connect = ConnectDB::getInstance();
        $accessTokenIs = $connect->findOne(Tables::WEB_PARSE, 'WHERE access_token_scantrigger = ?', [$accessToken]);
        if (isset($accessTokenIs)) {
            return self::getUniqueAccessTocken();
        } else {
            return $accessToken;
        }
    }

}
