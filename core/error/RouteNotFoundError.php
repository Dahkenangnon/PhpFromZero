<?php 

namespace PhpFromZero\Error;

use PhpFromZero\Error\BaseError;

/**
 * Route Not Found error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class RouteNotFoundError extends BaseError{


    public function __construct()
    {
        http_response_code(404);
    }
}