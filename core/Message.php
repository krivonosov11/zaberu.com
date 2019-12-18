<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core;

use application\models\data\Tables;
use core\Session;

/**
 * Description of Message
 *
 * @author user
 */
class Message
{

    public static $message = [];
    public static $status = [];
    public static $types = [];

    private static function clearMessage()
    {
        Session::unsetSession('message');
    }

    private static function clearStatus()
    {
        Session::unsetSession('message_status');
    }

    private static function clearTypes()
    {
        Session::unsetSession('message_type');
    }

    public static function clear()
    {
        self::clearMessage();
        self::clearStatus();
        self::clearTypes();
    }

    public static function getMessage()
    {
        if (self::$message === null || empty(self::$message)) {
            if (Session::getSession('message') !== false) {
                self::$message = Session::getSession('message');
            }
        }

        return self::$message;
    }


    public static function getStatus()
    {
        if (self::$status === null || empty(self::$status)) {
            if (Session::getSession('message_status') !== false) {
                self::$status = Session::getSession('message_status');
            }
        }
        return self::$status;
    }

    public static function getTypeMessage()
    {
        if (self::$types === null || empty(self::$types)) {
            if (Session::getSession('message_type') !== false) {
                self::$types = Session::getSession('message_type');
            }
        }
        return self::$types;
    }

    public static function setMessage($message, $status = '', $typeMessage = 1)
    {
        if ($status == '') {
            $status = MESSAGE_DEFAULT;
        }

        $array_message = self::getMessage();
        if (!in_array($message, $array_message)) {
            array_push($array_message, $message);
            Session::setSession('message', $array_message);
            self::$message = $array_message;
        }

        $array_status = self::getStatus();
        if (!in_array($status, $array_status)) {
            array_push($array_status, $status);
            Session::setSession('message_status', $array_status);
            self::$status = $array_status;
        }

        $message_types = self::getTypeMessage();
        if (!in_array($typeMessage, $message_types)) {
            array_push($message_types, $typeMessage);
            Session::setSession('message_type', $message_types);
            self::$types = $message_types;
        }
    }

    public static function clearMessageFromUser($userId)
    {
        $connect = ConnectDB::getInstance();
        $msg = $connect->findOne(Tables::USER_MESSAGES, 'WHERE user_id = ?', [$userId]);
        $connect->trash($msg);
    }

    public static function setMessageToUser($userId, $message, $status = '', $typeMessage = 1)
    {
        $connect = ConnectDB::getInstance();
        $newMsg = $connect->getRedBean()->dispense(Tables::USER_MESSAGES);
        $newMsg->user_id = $userId;
        $newMsg->message = $message;
        $newMsg->type = $typeMessage;
        $newMsg->status = $status;
        $connect->store($newMsg);
    }

    public static function displayMessage($clear = true)
    {
        $message = self::getMessage();
        $message = array_reverse($message); //we need inverted ordering (last on the top)
        $status = self::getStatus();
        $status = array_reverse($status); //we need inverted ordering (last on the top)
        $typeMessage = self::getTypeMessage();
        $typeMessage = array_reverse($typeMessage);

        $display = '';
        foreach ($message as $key => $value) {
            if (!isset($typeMessage[$key])) {
                $typeMessage[$key] = 1;
            }
            $methodName = 'drawMessageType' . $typeMessage[$key];
            $display .= self::$methodName($value, $status[$key]);

        }
        if ($clear) {
            self::clear();
        }
        return $display;
    }

    public static function drawMessageType1($message, $status)
    {
        $display = '';
        if ($status == MESSAGE_DANGER) {
            $color_text = 'orange';
        } else {
            $color_text = $status;
        }

        $display .= '<div class="message_scan white_text">';
        $display .= '<div class="' . $color_text . ' ' . $color_text . '-text">';
        $display .= '<div class="title_msg"><p>' . self::getTitle($status) . '<span class="close_msg">×</span></div>';
        $display .= ' <div class="content_msg">' . strtoupper($message) . '</div>';
        $display .= '</div>';
        $display .= '</div>';
        return $display;
    }

    public static function drawMessageType2($message, $status)
    {
        $display = '';
        $display .= '<div class="button_by_scan white_text wraper">';
        $display .= '<div class="content_msg">' . strtoupper($message);
        $display .= ' <a href="' . url('packages') . '"><div class="button_by"><span class="bold">Оплатить</span></div></a>';
        $display .= '</div>';
        $display .= '</div>';
        return $display;
    }

    public static function getTitle($status = '')
    {
        if ($status == '') {
            $status = MESSAGE_DEFAULT;
        }

        if ($status == MESSAGE_DEFAULT) {
            return \Lang::_('DEFAULT_TITLE_MESSAGE');
        } elseif ($status == MESSAGE_SUCCESS) {
            return \Lang::_('SUCCESS_TITLE_MESSAGE');
        } elseif ($status == MESSAGE_ERROR) {
            return \Lang::_('ERROR_TITLE_MESSAGE');
        } else {
            return \Lang::_('DANGER_TITLE_MESSAGE');
        }
    }

}

$js = "
$(document).ready(function(){

    $('.button_by').click(function(){
        $.ajax({
            'url': '/data/set-url-users',
            'dataType': 'text',
            'method': 'post',
            'data' : {url_site: '" . $_SERVER['REQUEST_URI'] . "'}
        });

    });
});
";
\Declaration::addScriptDeclaration($js);

