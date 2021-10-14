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
        $this->uri = new UrlParser();
        $this->hub = $this->hubFinder();        
        $this->class = '\Over_Code\controllers\\' . $this->hub . '\\' . $this->uri->getControllerClass() . 'Controller';
        $this->method = $this->undashedMethod($this->uri->getMethodName()); 
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

    /**
     * Delete dashes from method name, and trasform in camel case form
     *
     * @param string $getMethod
     * @return string
     */
    public function undashedMethod(string $getMethod): string
    {
        if (preg_match('/-/', $getMethod)) {
            $getMethod = explode('-', $getMethod);

            for ($i = 1; $i <= (count($getMethod) - 1); $i++) {
                $getMethod[$i] = ucfirst($getMethod[$i]);
            }
            
            return implode('', $getMethod);
        }

        return $getMethod;
    }
}