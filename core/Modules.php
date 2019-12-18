<?php

namespace core;

class Modules {

    public static $vars = [];
    private static $name_module;
    private static $class_module;
    protected $config;
    protected $helper;

    public function __construct() {
        $conf_file = ROOT . DS . 'modules' . DS . self::$name_module . DS . 'conf.php';
        if (is_file($conf_file)) {
            require_once $conf_file;
        } else {
            return;
        }
        $class_conf = self::$class_module . 'Conf';
        $this->config = new $class_conf();
        $helper_file = ROOT . DS . 'modules' . DS . self::$name_module . DS . 'helper.php';
        if (is_file($helper_file)) {
            require_once $helper_file;
        } else {
            return;
        }
        $class_helper = self::$class_module . 'Helper';
        $this->helper = new $class_helper();
    }

    public function showView() {
        $vars = self::$vars;
        $view = $this->config->view;
        $file_view = ROOT . DS . 'modules' . DS . self::$name_module . DS . 'view' . DS . $view . DS . 'view.php';
        ob_start();
        if (is_file($file_view)) {
            include $file_view;
        } else {
            echo 'Не найден вид ' . $file_view;
        }
        $content = ob_get_clean();
        return $content;
    }

    public static function setVar($var, $value) {
        self::$vars[$var] = $value;
    }

    public static function getModule($name) {
        self::$name_module = $name;
        $main_class_module = ROOT . DS . 'modules' . DS . $name . DS . $name . '.php';
        $vars = self::$vars;
        if (is_file($main_class_module)) {
            require_once $main_class_module;
            $main_class = str_replace(' ', '', ucwords(preg_replace('/_|-/', ' ', $name)));
            self::$class_module = $main_class;
            $object_module = new $main_class();
            $content = $object_module->showView();
        } else {
            $content = 'Module - not fount ' . $main_class_module;
        }
        return $content;
    }

}
