<?php

namespace PhpFromZero\Http\Bag;

/**
 * 
 * @var $_GET
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://Justin.Dah-kenangnon.com
 * @link https://Paonit.com
 * @link https://Dah-kenangnon.com
 */
class Get extends Bag
{
    public function __construct()
    {
        parent::__construct($_GET);
    }
}
