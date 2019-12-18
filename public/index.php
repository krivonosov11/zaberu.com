<?php

date_default_timezone_set("UTC");

$query = ltrim($_SERVER['REQUEST_URI'], '/');

$dirData = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR;

function url($url = "")
{
    $lang = Lang::initialiseLang();
    if (strpos($url, '/') === 0) {
        $url = substr($url, 1);
    }
    $langPrefix = $lang != DEFAULT_LANGUAGE ? $lang : '';
    $url = $url != '' ? $langPrefix . ($langPrefix != '' ? '/' : '') . $url : $langPrefix;
    $url = \Config::$url . '/' . $url;
    return $url;
}


require_once file_exists($dirData . 'defines_dev.php')
    ? ($dirData . 'defines_dev.php')
    : ($dirData . 'defines.php');
require_once file_exists(DATA_DIR . DS . 'config_dev.php')
    ? (DATA_DIR . DS . 'config_dev.php')
    : (DATA_DIR . DS . 'config.php');

error_reporting(\Config::$errorReporting);

require_once CORE . DS . 'BRequest.php';
require_once CORE . DS . 'Declaration.php';
require_once CORE . DS . 'Debug.php';
require_once CORE . DS . 'sessions' . DS . 'Session.php';
require_once CORE . DS . 'Lang.php';
if ($query == 'google33ff467dbf041ffd.html') {
    require_once dirname(__DIR__) . DS . 'google33ff467dbf041ffd.html';
    return;
}

use core\router;

spl_autoload_register(function ($class) {
    $file = ROOT . DS . str_replace('\\', DS, $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});
Router::dispatch($query);
