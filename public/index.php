<?php

/**
 * This file is the first one which is call when  PhpFromZero get an HTTP request
 *
 * It main role is to get request, delegate the handling process to the kernel
 * then get response from the kernel and send this reponse to the browser
 * 
 * 
 * (c) Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */


// Include autoload, require to load classes
require __DIR__ . '/../core/autoloader.php';


// Use the Request and the Kernel
use PhpFromZero\Http\Request;
use PhpFromZero\Kernel;
use PhpFromZero\Config\Config;
use PhpFromZero\Http\Response;
use PhpFromZero\Utils\Logger;
use PhpFromZero\Utils\Utils;


// We need the HTPP Request
$request = new Request();



// Handle error
set_exception_handler('exception_handler');

/**
 * This function handle all error non caught in the code
 */
function exception_handler($e)
{
    $config = new Config();
    $logger = new Logger();
    $statusCode = (http_response_code() < 100 or  http_response_code() > 511) ? 500 : http_response_code();
    $statusText = Utils::$statusTexts[$statusCode] ?? "Fatal Error";
    global $request;


    // Loggin can be enable or not
    if ($config->get("enableLog")) {
        // Log error
        $logger::log(
            msg: $e,
            url: $request->getUrl(),
            status: $statusCode
        );
    }




    if (0 === strcmp($config->getenv(), "dev")) {
        // In dev mode report all thing
        ini_set('error_reporting', E_ALL);
    } else {

        $errorPagePath = $config->getProjectDir() . '/core/templates/error/' . $statusCode . '.ep.php';

        if (file_exists($errorPagePath)) {
            $errorPageContent = require_once($errorPagePath);
        } else {
            $errorPageContent = require_once($config->getProjectDir() . '/core/templates/error/500.ep.php');
        }

        // Disable the Php default verbose error reporting
        error_reporting(0);
        $errorResponse = new Response(
            content: $errorPageContent,
            status: $statusCode,
            statusText: $statusText
        );
        $errorResponse->send();
    }
}


// We need the Kernel to handle request
$kernel = new Kernel();

// When a Request is send to this file, the Kernel handle it and get a Response object
$response = $kernel->handle($request);

// When everything is done (Routing, Controller and action, Database, etc), we send response to the browser and terminate the request
$response->send();
