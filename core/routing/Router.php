<?php

namespace PhpFromZero\Routing;

use PhpFromZero\Http\Request;
use PhpFromZero\Routing\Route;

/**
 * 
 * The route manager
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class Router
{
  protected $routes = [];

  const NO_ROUTE = 1;

  /**
   *  @var Request 
   */
  protected $request;


  public function __construct(Request $request)
  {
    $r = new \ReflectionObject($this);
    $dir = $r->getFileName();
    $xml = new \DOMDocument;
    $xml->load(dirname($dir, 3) . "/src/routes/Routes.xml");
    $routesXmls = $xml->getElementsByTagName('route');

    // On parcourt les routes du fichier XML.
    foreach ($routesXmls as $route) {
      $vars = [];

      // On regarde si des variables sont présentes dans l'URL.
      if ($route->hasAttribute('vars')) {
        $vars = explode(',', $route->getAttribute('vars'));
      }

      // On ajoute la route au routeur.
      $this->addRoute(new Route(
        $route->getAttribute('url'),
        $route->getAttribute('controller'),
        $route->getAttribute('action'),
        $vars
      ));
    }

    $this->request =   $request;
  }



  /**
   * Get the route matched by this ulr
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

    throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
  }



  public function addRoute(Route $route)
  {
    if (!in_array($route, $this->routes)) {
      $this->routes[] = $route;
    }
  }
}
