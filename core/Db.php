<?php
/**
 * Created by PhpStorm.
 * User: Vyacheslav Tsaryk
 * Date: 22.10.18
 * Time: 12:49
 */

namespace core;


class Db
{
    /**
     * @var null
     */
    private static $link = null;

    /**
     * @return \mysqli|null
     */
    private static function connect()
    {
        if (empty(self::$link)) {
            self::$link = mysqli_connect(\Config::$host, \Config::$user, \Config::$password, \Config::$dbname);

            self::$link->set_charset("utf8");
        }

        return self::$link;
    }

    /**
     * @param $query
     * @return array|null
     */
    public static function getAll($query)
    {
        self::connect();

        $res = mysqli_fetch_all(self::query($query), MYSQLI_ASSOC);

        return is_null($res) ? [] : $res;
    }

    /**
     * @param $query
     * @return array|null
     */
    public static function getRow($query)
    {
        self::connect();

        $res = mysqli_fetch_assoc(self::query($query));

        return is_null($res) ? [] : $res;
    }

    /**
     * @param $query
     * @return int|string
     */
    public static function add($query)
    {
        self::connect();

        try {
            self::query($query);
        } catch (\Exception $e){
            //
        }

        return self::getInsertId();
    }

    /**
     * @param $query
     * @return int
     */
    public static function delete($query)
    {
        self::connect();

        self::query($query);

        return self::getAffectedRows();
    }

    /**
     * @param $query
     * @return bool|\mysqli_result
     */
    public static function update($query)
    {
        self::connect();

        self::query($query);

        return self::getAffectedRows();
    }

    /**
     * @return int|string
     */
    public static function getInsertId()
    {
        return mysqli_insert_id(self::$link);
    }

    /**
     * @return int
     */
    public static function getAffectedRows()
    {
        return mysqli_affected_rows(self::$link);
    }

    /**
     * @param $query
     * @return bool|\mysqli_result
     */
    private static function query($query)
    {
        return mysqli_query(self::$link, $query);
    }
}