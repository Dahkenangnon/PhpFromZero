<?php

namespace PhpFromZero\Entity;
use ArrayAccess;

/**
 * Entity base class
 * 
 * Implement ArrayAccess to allow all our entities to be used as array
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class BaseEntity  implements ArrayAccess
{

    protected $id;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * 
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    private $container = array();


    public function __construct()
    {
        // Only public and protected properties can be access like array element
        $r = new \ReflectionClass($this);
        $rProps   = $r->getProperties(\ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PUBLIC);

        foreach ($rProps as $prop) {

            // The property name
            $name = $prop->getName();

            // This is necessary because using $prop->getvalue() 
            //will throw no access to protected properties. SO by 
            //doing this, we use the getter of the current object prop
            $getter = "get" . ucfirst($name); 
            $value = $this->$getter();

            $this->container[$name] = $value;
        }
    }

    /**
     * @see ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }


    /**
     * @see ArrayAccess
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }


    /**
     * @see ArrayAccess
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }


    /**
     * @see ArrayAccess
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

}
