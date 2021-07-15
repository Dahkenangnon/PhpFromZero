<?php

namespace PhpFromZero\HtmlForms\Field;

use PhpFromZero\HtmlForms\Field\FormField;



/**
 * Text form field
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class TextField extends FormField
{

    protected $view;


    public function render(String $name){

        // Retrieve attributes array
        $attributes = $this->getAttributes();

        // A text field has minimum this HTML code
        $this->view = "<input name=$name type=text ";


        // Add all other attributes like class, id, required etc.
        foreach ($attributes as $key => $value) {
            $this->view .=" $key='$value' ";
        }
        
        return $this->view." />";
    }

    /**
     * Cas the value into string
     */
    public static function cast($value){ 
        return (string) $value;
    }
}
