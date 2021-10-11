<?php

namespace Over_Code\Libraries\Routes;

use Over_Code\Libraries\Routes\UrlParser;

/**
 * Checking Url conformity with controller classes
 */
Class UrlChecker
{
    use \Over_Code\Libraries\Helpers;

    public function __construct()
    {
        $this->hub = $this->hubFinder();

        $this->uri = new UrlParser();
        $this->class = '\Over_Code\controllers\\' . $this->hub . '\\' . $this->uri->getControllerClass() . 'Controller';
        $this->method = $this->uri->getMethodName();
        $this->params = $this->uri->getAttributesList();
    }

    /**
     * Return controller check test
     *
     * @return bool
     */
    public function controllerCheck(): bool
    {
        return (class_exists($this->class));
    }

    /**
     * Return method check test
     *
     * @return bool
     */
    public function methodCheck(): bool
    {
        if ($this->controllerCheck()) {
            return (method_exists($this->class, $this->method));
        }

        return false;
    }
}