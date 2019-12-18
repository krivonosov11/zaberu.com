<?php

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
class Declaration
{

    public static $ExternalScriptToHead = "";
    public static $ExternalScriptToBody = "";
    public static $ExternalStyle = "";
    public static $ExternalTagToHead = "";

    public static $UrlDirExternalStyles = "/public/css/";
    public static $UrlDirExternalScripts = "/public/js/";

    /**
     * Статическая переменная, в которой мы
     * будем хранить экземпляр класса
     *
     * @var DataBase
     */
    protected static $_instance;

    /**
     * Закрываем доступ к функции вне класса.
     * Паттерн Singleton не допускает вызов
     * этой функции вне класса
     *
     */
    private function __construct()
    {

    }

    /**
     * Закрываем доступ к функции вне класса.
     * Паттерн Singleton не допускает вызов
     * этой функции вне класса
     *
     */
    private function __clone()
    {

    }

    /**
     * Статическая функция, которая возвращает
     * экземпляр класса или создает новый при
     * необходимости
     *
     */
    public static function getInstance()
    {
        // проверяем актуальность экземпляра
        if (null === self::$_instance) {
            // создаем новый экземпляр
            self::$_instance = new self();
        }
        // возвращаем созданный или существующий экземпляр
        return self::$_instance;
    }

    //add script file to body or to head
    public static function addScript($scriptName, $where = "body")
    {
        if (stripos($scriptName, self::$UrlDirExternalScripts) !== 0) {
            $scriptName = self::$UrlDirExternalScripts . $scriptName . '.js?v=' . Config::$v_cache_styles_and_js;
        }
        $scriptHtml = "<script src='" . $scriptName . "'></script>\n";
        switch ($where) {
            case "body":
                self::$ExternalScriptToBody .= $scriptHtml;
                break;
            case "head":
                self::$ExternalScriptToHead .= $scriptHtml;
                break;
            default:
                Debug::log("Trying to call Declaration::addScript with unknown param '$where'", DEBUG_ERROR);
        }
    }

    //add script code to body or to head
    public static function addScriptDeclaration($script, $where = "body")
    {
        $scriptHtml = "<script>" . $script . "</script>\n";
        switch ($where) {
            case "body":
                self::$ExternalScriptToBody .= $scriptHtml;
                break;
            case "head":
                self::$ExternalScriptToHead .= $scriptHtml;
                break;
            default:
                Debug::log("Trying to call Declaration::addScriptDeclaration with unknown param '$where'", DEBUG_ERROR);
        }
//        var_dump ($script, $scriptHtml); die();
    }

    //add style file to body or to head
    public static function addStyle($styleName)
    {
        $styleFullName = $styleName;
        if (stripos($styleName, self::$UrlDirExternalStyles) !== 0) {
            if (strpos($styleName, '.css') === false) {
                $styleFullName = self::$UrlDirExternalStyles . $styleName . '.css';
                $styleName .= '.css';
            }
        } else {
            $styleName = str_replace(self::$UrlDirExternalStyles, '', $styleName);
        }
        $styleVersion = '?v=' . Config::$v_cache_styles_and_js;
        $styleHtml = "<link rel='stylesheet' type='text/css' href='" . $styleFullName . $styleVersion . "'>\n";
        self::$ExternalStyle .= $styleHtml;
    }

    //add style code to body or to head
    public static function addStyleDeclaration($style)
    {
        $styleHtml = "<style>" . $style . "</style>" . "\n";
        self::$ExternalStyle .= $styleHtml;
    }

    //add external tag to head
    public static function addTagtoHead($html)
    {
        self::$ExternalTagToHead .= $html . "\n";
    }

}
