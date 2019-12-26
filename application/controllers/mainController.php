<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\controllers;

use application\models\Main;
use core\mvc\View;

/**
 * Description of authController
 *
 * @author user
 */
class MainController extends \core\mvc\Controller
{


    public function __construct($route)
    {
        parent::__construct($route);

    }

    public function index()
    {
        $reviewsView = View::getView('review/index');
        $this->set(compact('reviewsView'));
    }

    public function getListCitys()
    {

    }

}
