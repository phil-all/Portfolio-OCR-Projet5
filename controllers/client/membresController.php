<?php

namespace P5\Controllers\Client;

use P5\Libraries\Twig;
use P5\Controllers\MainController;

/**
 * Manage resgistration and log-in / out
 */
class MembresController extends MainController
{
    /**
     * Defines parameters to send to display method
     *
     * @param string $action : is the twig template
     * @param array $params : parameters in URI after .../membres/
     */
    public function __construct($action, $params = [])
    {
        $this->params = $params;

        $this->action = 'client' . DS . 'pageNotFound.twig';

        if ((isset($params[0]))) {

            if (count($params) === 1 && $params[0] === 'inscription-connexion') {

                $this->action = preg_replace('~membres~' , 'signin-login', $action);
            }
        }

        $this->twig = new Twig;
    }

    public function register()
    {

    }

    public function unregister()
    {

    }

    public function login()
    {

    }

    public function logout()
    {

    }

    // getters

    //setters
}