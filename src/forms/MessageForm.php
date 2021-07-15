<?php

namespace App\Forms;

use PhpFromZero\HtmlForms\Field\TextAreaField;
use PhpFromZero\HtmlForms\Field\TextField;
use PhpFromZero\HtmlForms\FormBuilder;


/**
 * Message form
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@epatriote.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 * @link https://Dah-kenangnon.com
 */
class MessageForm extends FormBuilder
{

    public function __construct(string $action)
    {
        parent::__construct(method: "POST", action: $action, attr: [
            "class" => "bg-grey", 

        ]);
    }

    /**
     * Build the form
     */
    public function build()
    {
    

       $this->submitButton->setLabel("Poster");

        $this
            ->add("title", TextField::class, [
                "id" => "title",
                "required" => true,
                "placeholder"=> "Titre du message",
                "class"=> "form-control"
            ])
            ->add("content", TextAreaField::class, [
                "id" => "content",
                "required" => true,
                "placeholder"=> "Contenu du message",
                "class"=> "form-control",
                "rows"=> "5"
            ]);
    }
}
