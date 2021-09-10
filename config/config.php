<?php

namespace P5\Config;

class Config
{
    public static function run()
    {
        self::init();

        self::autoload();

        self::routing();
    }

    private static function init()
    {
        // Define path constants
        define('CONTROLLERS_PATH', ROOT_DS . 'controllers' . DS);

        define('CORE_PATH' , ROOT_DS . 'core' . DS);

        define('LIB_PATH', ROOT_DS . 'libraries' . DS);

        define('MODELS_PATH', ROOT_DS . 'models' . DS);

        define('PUBLIC_PATH', ROOT_DS . 'public' . DS);

        define('CSS_PATH', PUBLIC_PATH . 'css' . DS);

        define('JS_PATH', PUBLIC_PATH . 'js' . DS);

        define('IMAGES_PATH', PUBLIC_PATH . 'images' . DS);

        define('UPLOADS_PATH', PUBLIC_PATH . 'uploads' . DS);

        define('VIEWS_PATH', ROOT_DS . 'views' . DS);

        // Start session
        session_start();
    }

    private static function autoload()
    {
        spl_autoload_register(array(
            __CLASS__,
            'load'
        ));
    }

    private static function load($class)
    {
        // Delete P5\ from $class, Replace \ by / and export result in an array
        $class = str_replace('P5\\', '', $class);
        $class = str_replace('\\', '/', $class);
        $array = explode('/', $class);

        // Get the last array entry in a new array and apply lcfirst
        $last = array_map('lcfirst', array_slice($array, -1        ));

        // Get the last key number of array, and replace in $file
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

    private static function routing()
    {
        // Instantiate the controller class and call method based on URL
    }

}