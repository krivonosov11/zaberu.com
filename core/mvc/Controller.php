<?php

namespace core\mvc;

use core\Access;
use core\Message;
use core\User;

/**
 * Description of controller
 *
 * @author BloodKad_user
 */
abstract class Controller
{

    public $route = [];
    public $view = 'index';
    public $layout = 'main';
    public $vars = [];
    public $ajax_method = false;
    public $title = 'Пассажирские перевозки';
    private $model_name;

    /**
     * @param $layout
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
        if ($this->model_name !== null) {
            $this_model_name = "application\models\\" . $this->model_name;
            $this->model = new $this_model_name();
        }
        $this->route_controller = mb_strtolower($this->route["controller"]);
        $this->route_action = mb_strtolower($this->route["action"]);
    }

    public function getView()
    {
        if (!$this->ajax_method) {
            $vObj = new View($this->route, $this->layout, $this->view, $this->title);
            $vObj->render($this->vars);
        }
    }

    public function set($vars)
    {
        foreach ($vars as $key => $value) {
            $this->vars[$key] = $value;
        }
    }

    public function loadResult($data = false)
    {
        $this->loadAjaxResult($data);
    }

    protected function isAjax()
    {
        if (\Config::$ajax_include) {
            return true;
        }
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            return true;
        }
        return false;
    }

    private function loadAjaxResult($data)
    {
        if ($this->isAjax()) {
            header('Content-Type: application/json');
            echo json_encode($data);
            die();
        } else {
            return false;
        }
    }

}
