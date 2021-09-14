<?php

namespace P5\Config;

class Autoloader
{
    static function run()
    {
        spl_autoload_register(array(
            __CLASS__,
            'load'
        ));
    }

    static function load($class)
    {
        // $class is like : P5\Folder\Sub-folder\ClassName
        // Export $class in an array, and delete P5
        $array = explode('\\', $class);
        unset($array[0]);

        // Get the ClassName in a new array and apply lcfirst
        $last = array_map('lcfirst', array_slice($array, -1));

        // Create new key with last $arrey key number, and delete firt one
        $last[array_key_last($array)] = $last[0];
        unset($last[0]);

        // Transform $array entry to lower case
        $array = array_map('strtolower',$array);

        // Replace last $array entry by $last entry, and implode it in $class
        $class = implode('/', array_replace($array, $last));

        if(file_exists(ROOT_DS . $class . '.php')) {
            require(ROOT_DS . $class . '.php');
        }
    }
}