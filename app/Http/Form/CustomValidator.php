<?php

namespace App\Http\Form;

use App\Http\Controllers\Component\ResponsesComponent;

/**
 * CustomValidator
 * This call a form validator class
 */
class CustomValidator
{

    protected $ResponseComponent;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->ResponseComponent = new ResponsesComponent();
    }

    /**
     * validate
     * 
     * @param array $request
     * @param string $class
     * 
     * @return JSON || boolean
     */
    public function validate($request, string $class)
    {
        // Declare object
        $formValidator = str_replace("{{$class}}", $class, "\App\Http\Form\{$class}");
        $formValidator = new $formValidator();
        // Validate inputs
        $error = $formValidator->validate($request);
        // Return Json reponse
        if (!($error === false)) {
            return $this->ResponseComponent->validationError($error);
        }
        // Return boolean
        return $error;
    }
}
