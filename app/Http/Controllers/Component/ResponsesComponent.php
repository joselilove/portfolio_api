<?php

namespace App\Http\Controllers\Component;

use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Route;

/**
 * ResponsesComponent
 * This is used for giving response
 */
class ResponsesComponent
{

    /**
     * _setResponseBody
     * 
     * @param array $body
     * @param integer $status
     * 
     * @return json response
     */
    private function _setResponseBody(array $body, int $status)
    {
        $response = response(json_encode($body, JSON_UNESCAPED_UNICODE), $status)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age' => '300',
                'Pragma' => 'no-cache'
            ]);

        $logMessages = [
            'URL' => request()->route()->uri,
            'response' => json_encode($body, JSON_UNESCAPED_UNICODE)
        ];

        Log::debug($logMessages);

        return $response;
    }

    /**
     * validationError
     */
    public function validationError($entity)
    {
        $status = 400;
        $body = [
            'status_code' => $status,
            'message_id' => 'INVALID_PARAMETERS',
            'message' => 'Invalid Parameters',
            'data' => $entity
        ];

        return $this->_setResponseBody($body, $status);
    }

    /**
     * authenticationFailed
     */
    public function authenticationFailed()
    {
        $status = 401;
        $body = [
            'status' => $status,
            'message_id' => 'AUTHENTICATION_FAILED',
            'message' => 'Authentication Failed'
        ];

        return $this->_setResponseBody($body, $status);
    }

    /**
     * success
     */
    public function success($entity = [])
    {
        $status = 200;

        $body = [
            'status_code' => $status,
            'message_id' => 'SUCCESS',
            'message' => 'Success'
        ];
        // Add data response if exist
        $body = empty($entity) ? $body : array_merge($body, ['data' => $entity]);

        return $this->_setResponseBody($body, $status);
    }

    /**
     * notFound
     */
    public function notFound()
    {
        $status = 404;

        $body = [
            'status_code' => $status,
            'message_id' => 'NOT_FOUND',
            'message' => 'Not Found'
        ];

        return $this->_setResponseBody($body, $status);
    }

    /**
     * insertAccessLogsFailed
     *
     * @param string $msgId
     * @return void
     */
    public function insertAccessLogsFailed($msgId)
    {
        $status = 409;

        $body = [
            'status_code' => $status,
            'message_id' => $msgId,
            'message' => config('const.MESSAGE.' . $msgId)
        ];

        return $this->_setResponseBody($body, $status);
    }
}
