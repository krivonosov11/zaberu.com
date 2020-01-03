<?php


namespace application\controllers;


use core\mvc\Controller;
use core\mvc\View;

class AboutController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function index()
    {
        $second_part = View::getView('/about/second_part', []);
        $this->set(compact('second_part'));
    }

}