<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;

/**
 * GetAccessLogsForm
 * 
 * Validate GetAccessLogsForm API inputs
 */
class GetAccessLogsForm
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
            // Validation
            'limit' => ['required', 'integer']
        ]);
        // Return Message
        if ($validator->fails()) {
            $errors = $validator->messages()->get('*');
            return $errors;
        }

        return false;
    }
}
