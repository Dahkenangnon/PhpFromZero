<?php

namespace PhpFromZero\HtmlForms\Field;

use PhpFromZero\Error\FormFieldBadTypeError;

/**
 * Base class for all form field
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
abstract class FormField
{

    /**
     * @var array
     */
    protected $attributes = [];


    /**
     * Get the value of all defined attributes of this form field
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    
    /**
     * Set the value of attributes
     *
     * @param  array  $attributes
     *
     * @return  self
     */ 
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get @var $attributeName attribute value
     *
     * @return  mixed
     */
    public function get(String $attributeName)
    {
        return $this->attributes[$attributeName];
    }

    /**
     * Check if this field has this field defined
     *
     * @return  bool
     */
    public function has(String $attributeName): bool
    {
        return isset($this->attributes[$attributeName]);
    }


    /**
     * Set @var $attributeName attribute value to @var $attributeValue
     * 
     * @return  self
     */
    public function set(String $attributeName, $attributeValue)
    {

        if (!is_string($attributeName)) throw  new FormFieldBadTypeError(message: "$attributeName has the bad type");

        $this->attributes[$attributeName] = $attributeValue;
        return $this;
    }


    /**
     * Generate the HTML code of the form field
     */
    abstract public function render(String $name);


    abstract public static function cast($value);
}
