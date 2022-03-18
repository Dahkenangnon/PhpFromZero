<?php

namespace App\Forms;

use PhpFromZero\HtmlForms\Field\TextField;
use PhpFromZero\HtmlForms\FormBuilder;

/**
 * Login Form
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://LaSyntax.com
 * @link https://Dah-kenangnon.com
 */
class LoginForm extends FormBuilder
{

    public function __construct(string $action)
    {
        parent::__construct(method: "POST", action: $action, attr: [
           
            "class"=> "form bg-info"
        ]);
    }

    /**
     * Build the form
     */
    public function build()
    {
    
       $this->submitButton->setLabel("Se connecter");

       $newAttr = $this->submitButton->getAttributes();
       $newAttr["class"] = "btn btn-primary btn-lg";
       $this->submitButton->setAttributes($newAttr);

        $this
            ->add("email", TextField::class, [
                "id" => "email",
                "required" => true,
                "placeholder"=> "Email",
                "class"=> "form-control"
            ])
            ->add("password", TextField::class, [
                "id" => "password",
                "required" => true,
                "class"=> "form-control",
                "placeholder"=> "Mot de passe"
            ]);
    }
}
