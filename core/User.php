<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

use application\models\data\Tables;

/*use core\Session;
use core\ConnectDB;
use application\models\Packages;*/

/**
 * Description of User
 *
 * @author user
 */
class User
{
    public static $id;
    public static $user_info;
    public static $package;
    public static $active_group;
    public static $authorised;
    public static $user_settings;
    public static $user_admin;
    protected static $_instance;

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
     * @return DataBase
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

    public static function setUserInfo($info)
    {
        self::getUserInfo();

        if (isset($info['password'])) {
            unset($info['password']);
        }
        if (is_array($info) && is_array(self::$user_info)) {
            $old_info = self::$user_info;
            foreach ($old_info as $key => $value) {
                if (!isset($info[$key])) {
                    $info[$key] = $value;
                }
            }
        }
        self::$user_info = $info;
        Session::setSession('admin', $info['admin']);
        Session::setSession('user_info', $info);
    }


    public static function getUserInfo()
    {
        if (null === self::$user_info) {
            self::$user_info = Session::getSession('user_info');
        }
        return self::$user_info;
    }


    public static function updateUserInfo()
    {
        $user_id = self::getId();
        $connect = ConnectDB::getInstance();
        $user_info = $connect->load(Tables::USERS, $user_id);
        $new_user_info = [];
        foreach ($user_info as $key => $value) {
            $new_user_info[$key] = $value;
        }
        self::setUserInfo($new_user_info);
        self::updatePackageInfo();

    }

    public static function setId($id)
    {
        self::$id = intval($id);
        self::$authorised = true;
        Session::setSession('user_id', $id);
    }

    public static function getId()
    {
        if (null === self::$id) {
            self::$id = Session::getSession('user_id');
        }
        return !self::$id ? 0 : self::$id;
    }

    public static function isAdmin()
    {
        $admin = Session::getSession('admin');
        if ($admin == '1') {
            return true;
        } else {
            return false;
        }
    }

    public static function authorised()
    {
        $user_id = self::getId();
        if (!isset($user_id) || empty($user_id)) {
            self::$authorised = false;
        } else {
            self::$authorised = true;
        }
        return self::$authorised;
    }

    public static function getUserInfoById($id)
    {
        $connect = ConnectDB::getInstance();
        $user_info = $connect->load('k_users', $id);
        return $user_info;
    }

    public static function logout()
    {
        Session::unsetSession();
    }


}
