<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

/**
 * Description of Session
 *
 * @author user
 */
class Session
{

    public function __construct()
    {
        if (!isset($_SESSION)) {
            $lifetime = 60 * 60 * 24 * 365;
            $path_sessions = CORE . DS . 'sessions' . DS . 'files';
            ini_set('session.gc_maxlifetime', $lifetime);
            ini_set('session.cookie_lifetime', $lifetime);
            ini_set('session.save_path', $path_sessions);
            ini_set('session.use_strict_mode', $path_sessions);

            session_set_cookie_params($lifetime, '/');
            session_start();
//            $sessionCookie = session_get_cookie_params();
//            $maxlifetime = ini_get("session.gc_maxlifetime");
        }
    }

    public static function start()
    {
        new self();
    }

    public static function setSession($key, $value)
    {
        new self();
        $_SESSION[$key] = $value;
    }

    public static function getSession($key)
    {
        new self();
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function unsetSession($key = false)
    {
        new self();
        if (!$key) {
            unset($_SESSION);
            session_regenerate_id();
            $res = session_destroy();
            if ($res == false) {
                \Debug::allLog('SESSION DESTROY RETURNED FALSE', DEBUG_ERROR);
            }
        } else {
            unset($_SESSION[$key]);
        }
    }

}
