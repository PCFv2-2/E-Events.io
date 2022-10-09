<?php

class Required{
    public static function getMainDir(){
        return __DIR__;
    }
}

function myAutoload($class)
{
    error_reporting(E_ERROR | E_PARSE);
    include __DIR__ . '/Classes/DataBase/' . $class . '.php';
    include __DIR__ . '/Classes/Enum/' . $class . '.php';
    include __DIR__ . '/Classes/Seasons/' . $class . '.php';
    include __DIR__ . '/Classes/User/' . $class . '.php';
    error_reporting(E_ALL);
}
spl_autoload_register('myAutoload');