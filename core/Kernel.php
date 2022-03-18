<?php

namespace  PhpFromZero;

use PhpFromZero\Config\Config;
use PhpFromZero\Error\ControllerMethodNotFoundError;
use PhpFromZero\Http\Request;
use PhpFromZero\Routing\Router;
use PhpFromZero\Utils\Logger;

/**
 *
 * The app Kernel to handle request and return HTTP Response
 * 
 * All request pass away this Object.
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 * @link https://Dah-kenangnon.com
 */
class Kernel
{
    /**
     * @var Router The router
     */
    protected $router;


    /**
     * @var Config The configuration component
     */
    protected $config;


    public function __construct()
    {

        $this->config = new Config();
    }



    /**
     * Handle the request
     * 
     * @param Request $request The HTTP request
     * 
     * @return Response The HTTP response
     */
    public function handle(Request $request)
    {

        // Log can be enable or not in your env.local.php file located in the project root dir
        if ($this->config->get("enableLog")) {
            // Log access
            Logger::log(
                msg: " User access",
                url: $request->getUrl(),
                status: http_response_code()
            );
        }

        // Instantiate a router for routing
        $this->router = new Router(request: $request);

        // Get the matched route
        $matchedRoute = $this->router->getRoute();
        
        // Eventual params
        $params = $matchedRoute->vars();
        // The action to execute
        $action = $matchedRoute->action();

        // Instantiate the controller
        $controllerClass = 'App\\Controllers\\' . $matchedRoute->controller();
        $newController = new $controllerClass;

        // Make sure the action is callable
        if(!method_exists($newController, $action)) throw new ControllerMethodNotFoundError();

        // Call the action and get back response
        return $newController->$action($request, ...$params);
    }
}
