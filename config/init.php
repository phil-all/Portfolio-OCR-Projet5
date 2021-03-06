<?php

namespace Over_Code\Config;

/**
 * Define constants
 */
class Init
{
    use \Over_code\Libraries\Helpers;

    /**
     * Initializes constants
     *
     * @return void
     */
    public static function start(): void
    {
        $requestScheme = self::getSERVER('REQUEST_SCHEME');

        $serverName = self::getSERVER('SERVER_NAME');

        $scriptName = preg_replace('[\/index.php]', '', self::getSERVER('SCRIPT_NAME'));

        // Define site
        define('SITE_NAME', 'Over_Code');

        define('SITE_ADRESS', $requestScheme . '://' . $serverName . $scriptName);

        define('SINGLE_ARTICLE', SITE_ADRESS . '/articles/numero/');
        
        // Define path constants
        define('CONTROLLERS_PATH', ROOT_DS . 'controllers' . DS);

        define('ADMIN_CONTROLLERS', CONTROLLERS_PATH . 'admin' . DS);

        define('CLIENT_CONTROLLERS', CONTROLLERS_PATH . 'client' . DS);

        define('DB_PATH', ROOT_DS . 'db' . DS);

        define('LIB_PATH', ROOT_DS . 'libraries' . DS);

        define('MODELS_PATH', ROOT_DS . 'models' . DS);

        define('PUBLIC_PATH', ROOT_DS . 'public' . DS);

        define('CSS_PATH', PUBLIC_PATH . 'css' . DS);

        define('JS_PATH', PUBLIC_PATH . 'js' . DS);

        define('IMAGES_PATH', PUBLIC_PATH . 'images' . DS);

        define('UPLOADS_PATH', PUBLIC_PATH . 'uploads' . DS);

        define('VIEWS_PATH', ROOT_DS . 'views' . DS);
    }
}
