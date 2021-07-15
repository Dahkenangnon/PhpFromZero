<?php

namespace  PhpFromZero;

use PhpFromZero\Config\Config;
use PhpFromZero\Http\Request;
use PhpFromZero\Routing\Router;
use PhpFromZero\Utils\Logger;

/**
 *
 * The app Kernel to handle request and return HTTP Response
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class Kernel
{
    /**
     * @var Router The router
     */
    protected $router;

  
    protected $config;


    public function __construct()
    {
       
        $this->config = new Config();
    }
    // /**
    //  * Set the router
    //  * 
    //  * @param Router $router The router
    //  * 
    //  * @return self
    //  */
    // public function setRouter(Router $router)
    // {
    //     $this->router = $router;
    //     $this->config = new Config();

    //     print($this->config);
    //     die();


    //     return $this;
    // }



    /**
     * Handle the request
     * 
     * @param Request $request The HTTP request
     * 
     * @return Response The HTTP response
     */
    public function handle(Request $request)
    {

        // Loggin can be enable or not
        if ($this->config->get("enableLog")) {
            // Log access
            Logger::log(
                msg: " User access",
                url: $request->getUrl(),
                status: http_response_code()
            );
        }

        $this->router = new Router(request: $request);
        
        //die('Hello');
        $matchedRoute = $this->router->getRoute($request);
        $params = $matchedRoute->vars();
        
        // Instantiate the controller
        $controllerClass = 'App\\Controllers\\' . $matchedRoute->controller();
        $newController = new $controllerClass;

        $action = $matchedRoute->action();

        // Call the action and get back response
        return $newController->$action($request, ...$params);
    }
   
}
