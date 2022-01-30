<?php

namespace PhpFromZero\Routing;

use PhpFromZero\Error\RouteNotFoundError;
use PhpFromZero\Http\Request;
use PhpFromZero\Routing\Route;

/**
 * 
 * The route manager
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class Router
{
    /**
     * The applications routes
     */
    protected $routes = [];


    /**
     *  @var Request  The http request object
     */
    protected $request;


    public function __construct(Request $request)
    {
        $r = new \ReflectionObject($this);
        $dir = $r->getFileName();
        $xml = new \DOMDocument;
        $xml->load(dirname($dir, 3) . "/src/routes/Routes.xml");
        $routesXmls = $xml->getElementsByTagName('route');

        // Loop through the project routes defined in the XML file
        foreach ($routesXmls as $route) {
            $vars = [];

            // Is this  url has some vars ?
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // Push the route in $this->routes
            $this->addRoute(new Route(
                $route->getAttribute('url'),
                $route->getAttribute('controller'),
                $route->getAttribute('action'),
                $vars
            ));
        }

        // Seting the request
        $this->request =   $request;
    }



    /**
     * Get the route matched by this url
     * 
     * @return Route
     */
    public function getRoute()
    {
        foreach ($this->routes as $route) {

            // If this route match $url
            if (($varsValues = $route->match($this->request->getUrl())) !== false) {

                // If any variables...
                if ($route->hasVars()) {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    // Insert these var in $listVars
                    // like: varName => varValue
                    foreach ($varsValues as $key => $match) {

                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }


                    // Now set the route var list
                    $route->setVars($listVars);
                }

                return $route;
            }
        }

        throw new RouteNotFoundError("This url don't match any route");
    }



    /**
     * 
     * Push application routes to the router @property $routes
     * 
     * @param Route $route
     * 
     * @return void
     */
    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes)) {
            $this->routes[] = $route;
        }
    }
}
