<?php

namespace PhpFromZero\Routing;
 



/**
 * Route
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class Route
{
  protected $action;
  protected $controller;
  protected $url;
  protected $varsNames;
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
   * @return bool
   */
  public function hasVars()
  {
    return !empty($this->varsNames);
  }
 

  /**
   * Check wether this route matched the given route url
   */
  public function match($url)
  {
    if (preg_match('`^'.$this->url.'$`', $url, $matches))
    {
      return $matches;
    }
    else
    {
      return false;
    }
  }
 

  /**
   * Set the route action
   */
  public function setAction($action)
  {
    if (is_string($action))
    {
      $this->action = $action;
    }
  }
 
  /**
   * Set the controller of the route
   */
  public function setController($controller)
  {
    if (is_string($controller))
    {
      $this->controller = $controller;
    }
  }
 

  /**
   * Set the url of this route
   */
  public function setUrl($url)
  {
    if (is_string($url))
    {
      $this->url = $url;
    }
  }
 

  /**
   * Set the route variables name
   */
  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }
 

  /**
   * Set the variables 
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
 
  public function controller()
  {
    return $this->controller;
  }
 
  public function vars()
  {
    return $this->vars;
  }
 
  public function varsNames()
  {
    return $this->varsNames;
  }
}