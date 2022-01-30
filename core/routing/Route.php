<?php

namespace PhpFromZero\Routing;

/**
 * Route
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class Route
{
    /**
     * @var string $action Method which will be call
     */
    protected $action;

    /**
     * @var string $controller The controller class name
     */
    protected $controller;

    /**
     * @var string $url Url of this route
     */
    protected $url;

    /**
     * @var array $varsNames The variables names
     */
    protected $varsNames;

    /**
     * @var array $vars The variables values
     */
    protected $vars = [];

    public function __construct($url, $controller, $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setController($controller);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }


    /**
     * Check whether this route has variables
     * 
     * @return bool
     */
    public function hasVars()
    {
        return !empty($this->varsNames);
    }


    /**
     * Check wether this route matched the given route url
     * 
     * @param string $url
     * 
     *  @return bool
     */
    public function match($url)
    {
        if (preg_match('`^' . $this->url . '$`', $url, $matches)) {
            return $matches;
        } else {
            return false;
        }
    }


    /**
     * Set the route action
     * 
     * @param string $action
     * 
     * @return void
     */
    public function setAction($action)
    {
        if (is_string($action)) {
            $this->action = $action;
        }
    }

    /**
     * Set the controller of the route
     * 
     * @param string $controller
     * 
     * @return void
     */
    public function setController($controller)
    {
        if (is_string($controller)) {
            $this->controller = $controller;
        }
    }


    /**
     * Set the url of this route
     * 
     * @param string $url
     * 
     * @return void
     */
    public function setUrl($url)
    {
        if (is_string($url)) {
            $this->url = $url;
        }
    }


    /**
     * Set the route variables name
     * 
     * @param array $varsNames
     * 
     * @return void
     */
    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }


    /**
     * Set the variables 
     * 
     * @param array $vars
     * 
     * @return void
     */
    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }


    /**
     * Set the action 
     */
    public function action()
    {
        return $this->action;
    }

    /**
     * Get the route controller
     */
    public function controller()
    {
        return $this->controller;
    }

    /**
     * Get the route vars values
     */
    public function vars()
    {
        return $this->vars;
    }

    /**
     * Get the route variables names
     */
    public function varsNames()
    {
        return $this->varsNames;
    }
}
