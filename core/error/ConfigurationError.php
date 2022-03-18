<?php 

namespace PhpFromZero\Error;

use Exception;


/**
 * Configuration error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 * @link https://Dah-kenangnon.com
 */
class ConfigurationError extends Exception{

    public function __construct()
    {
        http_response_code(500);
    }
}