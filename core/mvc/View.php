<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\mvc;

/**
 * Description of view
 *
 * @author BloodKad_user
 */
class View
{

    public $route = [];
    public $view = 'index';
    public $layout = 'main';
    public $title = '';
    private static $css = [];
    private static $js = [];

    public function __construct($route, $layout = '', $view = '', $title = '')
    {
        $this->route = $route;
        $this->layout = $layout ?: LAYOUT;
        $this->view = $view;
        $this->title = $title;
    }

    public function render($vars)
    {
        extract($vars);
        ob_start();
        $file_view = APP . DS . 'views' . DS . lcfirst($this->route['controller']) . DS . $this->view . '.php';
        if (is_file($file_view)) {
            include $file_view;
        } else {
            echo \Lang::_('not_fount_view') . $file_view;
        }
        $content = ob_get_clean();
        $file_layout = APP . DS . 'views' . DS . 'layout' . DS . 'templates' . DS . $this->layout . '.php';
        if (is_file($file_layout)) {
            require_once $file_layout;
        } else {
            echo 'layout not fount' . $file_layout;
        }
    }

    /**
     * @param $view
     * @param array $vars
     * @return string
     */
    public static function getView($view, $vars = [])
    {
        extract($vars);
        $file_view = APP . DS . 'views' . DS . $view . '.php';
        ob_start();
        if (is_file($file_view)) {
            include $file_view;
        } else {
            echo \Lang::_('not_fount_view') . $file_view;
        }
        return ob_get_clean();
    }
}
