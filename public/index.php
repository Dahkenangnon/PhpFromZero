<?php

/**
 * This file is the first one which is call when  PhpFromZero get an HTTP request
 * 
 * It is call usually the FRONT CONTROLLER
 *
 * It main role is to get request, delegate the handling process to the kernel
 * then get response from the kernel and send this reponse to the browser
 * 
 * 
 * (c) Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 * @link https://Dah-kenangnon.com
 */


// Include autoload, required to load classes
require __DIR__ . '/../core/autoloader.php';

// We need to used two classes here: Kernel and Request
use PhpFromZero\Http\Request;
use PhpFromZero\Kernel;
use PhpFromZero\Config\Config;
use PhpFromZero\Http\Response;
use PhpFromZero\Logger\Logger;
use PhpFromZero\Utils\Utils;


set_exception_handler('exception_handler');


/**
 * This function handle all error non caught in the code
 */
function exception_handler($e)
{
    // Config and logger component
    $config = new Config();

    // Determine the HTTP status code 
    $statusCode = (http_response_code() < 100 or  http_response_code() > 511) ? 500 : http_response_code();

    // Determine the HTTP status code text
    $statusText = Utils::$statusTexts[$statusCode] ?? "Fatal Error";

    // Loggin can be enable or disable
    // See param in env.local.php for more information

    Logger::info("Error: " . $e->getMessage() . " in " . $e->getFile() . " at line " . $e->getLine());


    // Error handling should different from `dev` or `prod` env
    if (0 === strcmp($config->getenv(), "dev")) {
        // In dev mode report all thing
        ini_set('error_reporting', E_ALL);

        echo "From line " . __LINE__ . " of file " . __FILE__ . " <br>";
        echo
        "<h1>PhpFromZero error:</h1> 
        From line " . __LINE__ . " of file " . __FILE__ . " <br>
        <h3>You're seeing this because you are in dev env & you enable log</h3> <pre>";
        print_r($e);
        echo "</pre>";
    } else {
        error_reporting(0);

        // Deplay error page in production
        $errorPagePath = $config->getProjectDir() . '/templates/error/' . $statusCode . '.ep.php';
        if (file_exists($errorPagePath)) {
            $errorPageContent = require_once($errorPagePath);
        } else {
            $errorPageContent = require_once($config->getProjectDir() . '/core/templates/error/' . $statusCode . '.ep.php');
        }

        // Disable the Php default verbose error reporting
        $errorResponse = new Response(
            content: $errorPageContent,
            status: $statusCode,
            statusText: $statusText
        );

        // Send the error response code
        $errorResponse->send();
    }
}

// We need the HTPP Request to request
$request = new Request();


// We need the Kernel to handle request
$kernel = new Kernel();

// When a Request is sent to this file, the Kernel is delegated to handle it and return a Response object
$response = $kernel->handle($request);


// When everything is done (Routing, Controller>action, Database, form, log, etc),
// we send response to the browser and terminate the request
$response->send();

// Response is sent to the browser.
// Another request is waiting... (Remember, HTTP is Stateless)
