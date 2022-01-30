<?php 

namespace PhpFromZero\Error;

use PhpFromZero\Error\BaseError;


/**
 * Route param bad type error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 */
class UrlParamBadTypeError extends BaseError{

    public function __construct()
    {
        http_response_code(400);
    }
}