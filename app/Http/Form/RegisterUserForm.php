<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;

/**
 * RegisterUserForm
 * validate register API inputs
 */
class RegisterUserForm
{
    /**
     * Validate input
     * 
     * @param Request $request
     * 
     * @return Array || Boolean
     */
    public function validate($request)
    {
        $validator = Validator::make($request->all(), [
            // Validation here
            'body' => 'required'
        ]);
        // Return Message
        if ($validator->fails()) {
            $errors = $validator->messages()->get('*');
            return $errors;
        }

        return false;
    }
}
