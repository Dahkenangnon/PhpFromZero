<?php 

namespace PhpFromZero\Error;

use PhpFromZero\Error\BaseError;


/**
 * Bad Url error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class BadUrlError extends BaseError{

    public function __construct()
    {
        http_response_code(400);
    }
}