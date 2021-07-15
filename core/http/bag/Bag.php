<?php 

namespace PhpFromZero\Http\Bag;


/**
 * HTTP datas container base class
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class Bag
{
    protected $container;

    
    public function __construct($container)
    {
        $this->container = $container;
    }


    public function has(String $key): bool {

        return isset($container[$key]);
    }


    public function get(String $key){
        return $this->container[$key];
    }

    public function set(String $key, $value){


        if($this->container === $_COOKIE){
            throw new \Exception("Cookies must be set on the response", 1);
            
        }
        

        $this->container[$key] = $value;
        return $this;
    }


    public function all(){
        return $this->container;
    }

    public function isSet(){
        return isset($this->container) && !empty($this->container);
    }
}
