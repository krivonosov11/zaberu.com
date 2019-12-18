<?php

namespace core;

class Router
{

    protected static $rootes = []; // table of routs
    protected static $roote = []; // current rout
    public static $defaultAction = 'index';
    public static $defaultController = 'main';

    public static function add($reqexp, $route = [])
    {
        self::$rootes[$reqexp] = $route;
    }

    public static function getRoutes()
    {
        return self::$rootes;
    }

    public static function getRoute()
    {
        return self::$roote;
    }

    public static function matchRoute($url)
    {
        foreach (self::$rootes as $key => $value) {
            if (preg_match("#$key#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    if (is_string($k)) {
                        $value[$k] = $v;
                    }
                }
                self::$roote = $value;
                if (!isset(self::$roote['action'])) {
                    self::$roote['action'] = self::$defaultAction; // default action
                }
                return true;
            }
        }
        return false;
    }

    private static function setBackUrl()
    {
        $backUrl = '';
        if (self::lowerCamelCase(self::$roote['controller']) != self::$defaultController) {
            $backUrl = self::$roote['controller'];
            if (self::lowerCamelCase(self::$roote['action']) != self::$defaultAction) {
                $backUrl .= '/' . self::$roote['action'];
            }
        }
        if (self::$roote['controller'] != 'auth') {
            Session::setSession('backUrl', $backUrl);
        }

        if (\BRequest::getString('callback', '') != '') {
            $backUrl = urldecode(\BRequest::getString('callback', ''));
            Session::setSession('backUrl', $backUrl);
        }
    }

    public static function dispatch($url)
    {
        require_once(DATA_DIR . DS . "routes.php"); // createRoutes
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'application\controllers\\' . self::lowerCamelCase(self::$roote['controller']) . 'Controller';
            if (class_exists($controller)) {
                $controllerObj = new $controller(self::$roote);
                $controllerObj->ajax_method = preg_match('/(.*)-ajax$/i', self::$roote['action']);
                if ($controllerObj->ajax_method) {
                    self::$roote['action'] = preg_replace('/-ajax$/i', '', self::$roote['action']);
                }

                $action = self::lowerCamelCase(self::$roote['action']);
                if (method_exists($controllerObj, $action)) {
                    try {
                        $controllerObj->$action();
                        $controllerObj->getView();
                        if (!$controllerObj->ajax_method) {
                            self::setBackUrl();
                        }
                    } catch (\Exception $e) {
                        if (\Config::$showErrors) {
                            echo $e->getMessage() . '<br><br>' . "\n\n";
                            var_dump($e);
                        } else {
                            http_response_code(500);
                            require_once HTML_DIR . DS . 'errors' . DS . '500.php';
                        }
                    }
                } else {
                    http_response_code(404);
                    require_once HTML_DIR . DS . 'errors' . DS . '404.php';
                    echo 'action not found';
                    return;
                }
            } else {
                http_response_code(404);
                require_once HTML_DIR . DS . 'errors' . DS . '404.php';
                echo 'controller not found';
                return;
            }
        } else {
            http_response_code(404);
            require_once HTML_DIR . DS . 'errors' . DS . '404.php';
            return;
        }
    }

// delete '-' and upper firsts symbol for controller
    protected static function upperCamelCase($string)
    {
        $string = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        return $string;
    }

// delete '-' and lower first symbol for action (test-action = testAction)
    protected static function lowerCamelCase($string)
    {
        $string = lcfirst(self::upperCamelCase($string));
        return $string;
    }

//Это чтобы потом в масиве route не было GET параметров с URL
    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('?', $url, 2);
            if (false === strpos($params[0], '=')) {
                return rtrim($params[0], '/');
            } else {
                return '';
            }
        }
        return $url;
    }

}
