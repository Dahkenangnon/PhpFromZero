<?php 

namespace PhpFromZero\Error;

use PhpFromZero\Error\BaseError;


/**
 * PDO error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class OrmError extends BaseError{

    public function __construct()
    {
        http_response_code(500);
    }
}