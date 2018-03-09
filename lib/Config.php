<?php
/**
 * Created by PhpStorm.
 * User: Ростислав
 * Date: 09.03.2018
 * Time: 19:11
 */

class Config
{
    protected static $settings = [];

    public static function get($key)
    {
        return isset(self::$settings[$key]) ? self::$settings[$key] : null;
    }

    public static function set($key, $value)
    {
        self::$settings[$key] = $value;
    }
}