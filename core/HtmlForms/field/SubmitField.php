<?php

namespace PhpFromZero\HtmlForms\Field;

use PhpFromZero\HtmlForms\Field\FormField;



/**
 * Button for the form to be submitted
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class SubmitField extends FormField
{
    
    protected $view;
    protected $label;


    public function render(String $name){

        // Retrieve attributes array
        $attributes = $this->getAttributes();

        // A text field has minimum this HTML code
        $this->view = "<button name='$name' type='submit' ";


        // Add all other attributes like class, id, required etc.
        foreach ($attributes as $key => $value) {
            $this->view .=" $key='$value' ";
        }
        
        $label = $this->getLabel();
        return $this->view."/>$label</button>";
    } 

    /**
     * Get the value of label
     */ 
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set the value of label
     *
     * @return  self
     */ 
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public static function cast($value){ 
    }
}

