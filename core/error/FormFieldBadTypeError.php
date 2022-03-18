<?php 

namespace PhpFromZero\Error;

use PhpFromZero\Error\BaseError;



/**
 * Bad form field type error
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 * @link https://Dah-kenangnon.com
 */
class FormFieldBadTypeError extends BaseError{
    public function __construct()
    {
        http_response_code(500);
    }

}