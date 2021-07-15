<?php


namespace PhpFromZero\Controller;

use PhpFromZero\Config\Config;
use PhpFromZero\Http\Request;
use PhpFromZero\Http\Response;
use PhpFromZero\Routing\Router;
use PhpFromZero\Utils\Utils;

/**
 * 
 * Controller base class
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class BaseController
{

    /**
     * @var Config Configurations container
     */
    protected $config;


    public function __construct()
    {
        $this->config = new Config();

        
    }



    /**
     * Create HTTP  response object with an HTML content
     * 
     * 
     * @param String $viewPath The path relatively to the root templates dir
     * 
     * @param array $_ Paramers or variables needed by the templates
     * 
     * @return Response The HTTP response object
     */
    public function render(String $viewPath, array $_): Response
    {
       
        // Get the root dir
        $projectDir = $this->config->getProjectDir();

         // Make available our defined function to be used in the templates
         include_once($projectDir . '/core/templates/functions/dot.ep.php');


        // Define the 2 templates: core or user defined
        $defaultTemplates = $projectDir . '/core/templates/default.ep.php';
        $userTemplates = $projectDir . '/templates/' . $viewPath;


        // Make sure we send a page, even the default one
        if (file_exists($userTemplates)) {
            $file2RequirePath = $userTemplates;
        } else {
            $file2RequirePath = $defaultTemplates;
        }

        // Turn on output buffering
        ob_start();

        // Include the templates content
        $rawContent = include_once($file2RequirePath);

        // Execute the php content
        exec($rawContent);

        // Catch all the content of the buffer
        $output = ob_get_contents();

        // Turn off output buffering
        ob_end_clean();

        // Return now the response
        return new Response($output, 200, "OK", ["Content-Type" => "text/html"]);
    }



    /**
     * Create HTTP  response error with an HTML content
     * 
     * 
     * @param int $status The HTTP Status Code
     * 
     * @param array $_ Paramers or variables needed by the templates
     * 
     * @return Response The HTTP response object
     */
    public function createErrorPage(int $status, array $_): Response
    {

        // Get the root dir
        $projectDir = $this->config->getProjectDir();

        // Define the 2 templates: core or user defined
        $coreErrorTemplates = $projectDir . '/core/templates/error/' . $status . '.ep.php';
        $userErrorTemplates = $projectDir . '/templates/error/' . $status . '.ep.php';


        // Give priority to the user error templates
        if (file_exists($userErrorTemplates)) {
            $file2RequirePath = $userErrorTemplates;
        } else {
            $file2RequirePath = $coreErrorTemplates;
        }


        // I defined this here because i vant it will be available in our template
        $statusText = Utils::$statusTexts[$status];


        // Turn on output buffering
        ob_start();

        // Include the templates content
        $rawContent = require($file2RequirePath);

        // Execute the php content
        exec($rawContent);

        // Catch all the content of the buffer
        $output = ob_get_contents();

        // Turn off output buffering
        ob_end_clean();


        return new Response($output, $status, $statusText, ["Content-Type" => "text/html"]);
    }



    /**
     * Make a redirection
     */
    public function redirect(Request $request, string $url){

        return header('Location: '.$this->config->getBaseUrl().''.$url);
    }

}
