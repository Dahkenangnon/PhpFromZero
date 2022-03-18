<?php

namespace PhpFromZero\Http\Bag;

use PhpFromZero\Http\Bag\File;



/**
 * @var $_FILES
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 * @link https://Dah-kenangnon.com
 */
class Files
{

    protected $container;

    public function __construct()
    {
        $this->container = $_FILES;
    }


    public function get(string $key)
    {
        return $this->container[$key];
        return new File($this->container[$key]);
    }



    public function isSet()
    {

        // There are no file field in the form
        if (!isset($this->container) or empty($this->container)) {

            return false;
        }


        // There at least one file field but any of them is sent to the server
        $fileEntry = array_values($this->container);
        if (!isset($fileEntry) or empty($fileEntry)) {
            return false;
        }


        // The are file field but any file is selected/uploaded
        $firstElement = $fileEntry[0];
        if (!isset($firstElement) or empty($firstElement["name"])) {
            return false;
        }

        return true;
    }
}
