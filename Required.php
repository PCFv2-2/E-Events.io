<?php

class Required{
    public static function getMainDir(){
        return __DIR__;
    }
}

function myAutoload($class)
{
    error_reporting(E_ERROR | E_PARSE);
    include __DIR__ . '/BackEnd/Classes/DataBase/' . $class . '.php';
    include __DIR__ . '/BackEnd/Classes/Enum/' . $class . '.php';
    include __DIR__ . '/BackEnd/Classes/Seasons/' . $class . '.php';
    include __DIR__ . '/BackEnd/Classes/User/' . $class . '.php';
    error_reporting(E_ALL);
}
spl_autoload_register('myAutoload');