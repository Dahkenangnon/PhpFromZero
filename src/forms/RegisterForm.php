<?php

namespace App\Forms;

use PhpFromZero\HtmlForms\Field\FileField;
use PhpFromZero\HtmlForms\Field\NumberField;
use PhpFromZero\HtmlForms\Field\TextField;
use PhpFromZero\HtmlForms\FormBuilder;


/**
 * Register form
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
class RegisterForm extends FormBuilder
{

    public function __construct(string $action)
    {
        parent::__construct(method: "POST", action: $action, attr: [
            "enctype"=>"multipart/form-data"

        ]);
    }

    /**
     * Build the form
     */
    public function build()
    {
        // Override thing here like, submit button label, form name, form id
        
        //$this->submitButton->setLabel("S'inscrire");

        $this
            ->add("email", TextField::class, [
                "id" => "email",
                
                "placeholder"=> "Bossor, ton email ici",
                "class"=> "form-control"
            ])
            ->add("name", TextField::class, [
                "id" => "name",
                
                "placeholder"=> "Asso, ton nom ici",
                "class"=> "form-control"
            ])
            ->add("photo", FileField::class, [
                "id" => "photo",
                "class"=> "form-control"
            ])
            ->add("age", NumberField::class, [
                "id" => "age",
                
                "placeholder"=> "Ton age",
                "class"=> "form-control"
            ])
            ->add("password", TextField::class, [
                "id" => "password",
                
                "placeholder"=> "Mot de passe or",
                "class"=> "form-control"
            ])
            ->add("password_confirmation", TextField::class, [
                "id" => "password_confirmation",
                
                "placeholder"=> "Confirme le mot de passe",
                "class"=> "form-control"
            ]);
    }
}
