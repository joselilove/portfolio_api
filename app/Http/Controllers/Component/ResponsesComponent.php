<?php

namespace App\Http\Controllers\Component;

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

        return $response;
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
    public function success(array $entity = [])
    {
        $status = 200;

        $body = [
            'status_code' => 200,
            'message_id' => 'SUCCESS',
            'message' => 'Success'
        ];
        // Add data response if exist
        $body = empty($entity) ? $body : array_merge($body, ['data' => $entity]);

        return $this->_setResponseBody($body, $status);
    }
}
