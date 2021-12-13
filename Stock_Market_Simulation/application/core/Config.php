<?php

namespace application\core;

class Config{

    public static $config;

    public static function get($key)
    {
        if (!self::$config) {

            $config_file = '..\application\config\config.development.php';

            if (!file_exists($config_file)) {
                return false;
            }

            self::$config = require $config_file;
        }

        return self::$config[$key];
    }
}