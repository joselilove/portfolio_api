<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Component\ResponsesComponent;
use App\Http\Form\CustomValidator;
use App\Models\AccessLog;

class PortfolioController extends Controller
{
    protected $ResponseComponent;
    protected $CustomValidator;
    protected $AccessLog;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->ResponseComponent = new ResponsesComponent();
        $this->CustomValidator = new CustomValidator();
        $this->AccessLog = new AccessLog();
    }

    public function getToken()
    {
        $newToken['token'] = Hash::make(config('const.API-TOKEN'));

        return $this->ResponseComponent->success($newToken);
    }

    /**
     * insertAccessLogs
     */
    public function insertAccessLogs(Request $request)
    {
        $validationMessage = $this->CustomValidator->validate($request, 'InsertAccessLogsForm');

        if (!($validationMessage === false)) {
            return $validationMessage;
        }

        if ($this->AccessLog->insertAccessLogs()) {
            return $this->ResponseComponent->insertAccessLogsFailed('INSERT_ACCESS_LOGS_FAILED');
        }

        return $this->ResponseComponent->success();
    }

    /**
     * getAccessLogs
     */
    public function getAccessLogs(Request $request)
    {
        $validationMessage = $this->CustomValidator->validate($request, 'GetAccessLogsForm');

        if (!($validationMessage === false)) {
            return $validationMessage;
        }

        $accessLogData = $this->AccessLog->getAccessLogs();

        if (empty($accessLogData)) {
            return $this->ResponseComponent->notFound();
        }

        return $this->ResponseComponent->success($accessLogData);
    }
}
