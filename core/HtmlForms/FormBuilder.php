<?php

namespace PhpFromZero\HtmlForms;

use PhpFromZero\HtmlForms\Field\FileField;
use PhpFromZero\HtmlForms\Field\SubmitField;
use PhpFromZero\Http\Request;

/**
 * HTML form base class
 * 
 * @author Justin Dah-kenangnon <dah.kenangnon@gmail.com>
 * 
 * @link https://github.com/Dahkenangnon
 * @link https://ePatriote.com
 * @link https://Creative.ePatriote.com
 */
abstract class FormBuilder
{

    /**
     * @var array The form fields
     */
    protected $fields;

    /**
     * @var String
     */
    protected $fieldsView;

    /**
     * @var String
     */
    protected $view;

    /**
     * @var SubmitField
     */
    protected $submitButton;

    /**
     *  @var String The Form name 
     */
    protected  $name;

    /**
     *  @var String The Form id 
     */
    protected  $id;

    /**
     *  @var String The Form submit button label 
     */
    protected $submitButtonlabel;

    /**
     *  @var String The Form submit button name 
     */
    protected $submitButtonName;

    /**
     *  @var Array The Form submit button attri 
     */
    protected $submitButtonAttr;


    /**
     * @var array
     */
    protected $data;


    /**
     * @var bool
     */
    protected $isSubmitted;



    public function __construct(
        protected String $method,
        protected String $action,
        protected array $attr
    ) {

        // Form name and it same as the form class name
        $this->name = $this->getMyName();
        $this->id = $this->getMyName();

        $this->fields = [];

        // This can be override by the user defined build() method
        $this->submitButtonlabel = "Submit";
        $this->submitButtonName = $this->name . "_submit_button";
        $this->submitButtonAttr = ["id" => $this->name . "_submit_button"];
        $this->submitButton = new SubmitField();
        $this->submitButton->setLabel($this->submitButtonlabel);

        // Build the form
        $this->build();

        // By default form is not submitted
        $this->isSubmitted = false;
    }


    /**
     * This build fonction must mainly do theses actions:
     * 
     * 1. Set the properties (name, action, method) of the form
     * 
     * 2. Add fields to the form
     * 
     * 3. Override somethings like: submitted button label, etc
     */

    abstract public function build();


    /**
     * Build the submit button of the form
     */
    public function buildSubmitButton()
    {
        $this->submitButton->setAttributes($this->submitButtonAttr);
        return $this->submitButton->render($this->submitButtonName);
    }


    /**
     * Add field to the form
     */
    public function add(String $name,  $FormTypeClass, array $attr)
    {
        $this->fields["$name"] = [
            "class" => $FormTypeClass,
            "attr" => $attr
        ];

        return $this;
    }


    /**
     * Render the fields's view as HTML code 
     * 
     * @return String
     */
    private function renderFields(): String
    {

        foreach ($this->fields as $name => $field) {

            $FieldClass =  $field['class'];
            $attr =  $field['attr'];

            // Instantiate the new field class
            $newField = new $FieldClass();

            // Set the field attributes
            $newField->setAttributes($attr);

            // Get it HTML code
            $newFieldView = $newField->render($name);

            // Append it
            $this->fieldsView .= "<br> <br> " . $newFieldView;
        }

        return $this->fieldsView;
    }



    /**
     * Render the form view as HTML code
     * 
     * @return String
     */
    public function render(): String
    {

        $this->view = "<form action='$this->action' method='$this->method' name='$this->name' id='$this->id'";

        // Add all other attributes like class, id, required etc.
        foreach ($this->attr as $key => $value) {
            $this->view .= " $key=$value ";
        }
        $this->view .= "/>";

        // Add field's HTML code
        $fieldsView = $this->renderFields();
        $this->view .= " <br> $fieldsView";

        // Add submit button HTML code
        $submitButtonView = $this->buildSubmitButton();
        $this->view .= " <br> $submitButtonView";

        // Close the form tag
        $this->view .= " <br> </form>";

        return $this->view;
    }



    /**
     * Get the value of submitButton
     *
     * @return  SubmitField
     */
    public function getSubmitButton()
    {
        return $this->submitButton;
    }




    /**
     * 
     * Get the form class name 
     */
    protected function getMyName(String $type = "ShortName")
    {

        $me = new \ReflectionClass($this);
        $getter = "get" . ucfirst($type);
        return strtolower($me->$getter());
    }



    /**
     * Get the Form id
     *
     * @return  String
     */
    public function getId()
    {
        if ($this->id === null) {
            return $this->getMyName();
        }

        return $this->id;
    }



    /**
     * Set the Form id
     *
     * @param  String  $id  The Form id
     *
     * 
     */
    public function setId(String $id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Check if the form is submitted and set fields's data
     * 
     * @param Request The Http $request
     * 
     * @return void
     */
    public function handle(Request $request)
    {

        // Getter to get the global var which hold our form field value
        $method = $request->getMethod();
        $getterHolder  = "get" . ucfirst(strtolower($method));
        $holder = $request->$getterHolder();


        if ($holder->isSet()) {
            $fileFieldKey = [];

            $fieldKeysName = array_keys($this->fields);

            // Add post 
            foreach ($fieldKeysName as $key) {

                // Skype the file field
                if (new $this->fields[$key]['class'] instanceof FileField) {
                    $fileFieldKey[] = $key;
                    continue;
                }

                // Create new instance of this field class
                $object = new $this->fields[$key]['class'];

                // Cast the value into the right type
                $this->data[$key] = $object::cast($holder->get($key));
            }

            // If any file, add it data
            if ($request->hasUploadedFile()) {
                
                $files = $request->getFiles();
                foreach ($fileFieldKey as $key) {
                    $this->data[$key] = $files->get($key);
                }
                
            }
            $this->isSubmitted = true;
        }
       
    }


    /**
     * Get all the array container the submitted data
     * 
     * @return array
     */
    public function getData(){

        return $this->data;
    }


    /**
     * Get the value for a given field
     * 
     * @return string
     */
    public function get($key){

        return $this->data[$key];
    }

    /**
     * Get the value of isSubmitted
     *
     * @return  bool
     */ 
    public function isSubmitted()
    {
        return $this->isSubmitted;
    }
}
