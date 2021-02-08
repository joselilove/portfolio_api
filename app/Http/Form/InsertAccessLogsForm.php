<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;

/**
 * InsertAccessLogsForm
 * 
 * Validate InsertAccessLogs API inputs
 */
class InsertAccessLogsForm
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
