<?php


namespace vendor\core;

class Registry
{
    public static $objects = [];
    protected static $instance;

    public static function getInstance()
    {
        if(self::$instance === null) {
            self::$instance = new self();
            return self::$instance;
        } else {
            return self::$instance;
        }
    }

    protected function __construct()
    {
        require CONFIG . "/config.php";
        foreach ($config['components'] as $name => $component) {
            self::$objects[$name] = new $component();
        }
    }

    public function __get($name)
    {
        if(is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }

    public function __set($name, $obj)
    {
        if(!isset(self::$objects[$name])) {
            self::$objects[$name] = new $obj;
        }
    }

    public function getList()
    {
        debug(self::$objects);
    }
}