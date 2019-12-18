<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\mvc;

use core\ConnectDB;

/**
 * Description of model
 *
 * @author BloodKad and Yura Galin
 */
class Model
{

    protected $pk = 'id';
    public $table;
    public $user;
    public $connect;
    public $message;
    public $google_service;

    public function __construct()
    {

    }

}