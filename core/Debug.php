<?php

/**
 * Description of DataBase
 *
 * @author Brilliant
 */
class Debug
{

    public static $debugQueriesDB = '';
    public static $countDebugQueriesDB = 0;

    public static function setDebugQueriesDB($msg, $from_where)
    {
        self::$countDebugQueriesDB++;
        $t = microtime(true);
        $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
        $d = new DateTime(date('Y-m-d H:i:s.' . $micro, $t));
        self::$debugQueriesDB .= '<p>' .
            $d->format("Y-m-d H:i:s.u") . ': <b>' . $msg . '</b>' .
            "<br /><span class = 'grey-text'>Запрос в БД сделан отсюда: " . $from_where . "</span>" .
            '</p>';
    }

    public static function showDebugQueriesDB()
    {
        if (!Config::$debugQueriesDB) {
            return false;
        }

        $message = "<div class = 'card p-3 mt-1 mb-1'><h4><strong>Системные debug-сообщения</strong></h4>"
            . "<h5><strong>Всего выполнено запросов в базу данных - " . self::$countDebugQueriesDB . "</strong></h5><br />" . self::$debugQueriesDB . "</div>";
        return $message;
    }


}
