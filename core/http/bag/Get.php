<?php

namespace PhpFromZero\Http\Bag;

/**
 * 
 * @var $_GET
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class Get extends Bag
{
    public function __construct()
    {
        parent::__construct($_GET);
    }
}
