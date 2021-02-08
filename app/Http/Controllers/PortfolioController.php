<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Component\ResponsesComponent;
use App\Http\Form\CustomValidator;

class PortfolioController extends Controller
{
    protected $ResponseComponent;
    protected $CustomValidator;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->ResponseComponent = new ResponsesComponent();
        $this->CustomValidator = new CustomValidator();
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
        $validatationMessaeg = $this->CustomValidator->validate($request, 'InsertAccessLogsForm');

        if (!($validatationMessaeg === false)) {
            return $validatationMessaeg;
        }

        return $this->ResponseComponent->success();
    }

    /**
     * getAccessLogs
     */
    public function getAccessLogs()
    {
        $data = [
            [
                'address' => $_SERVER['REMOTE_ADDR'],
                'machine_name' => gethostname(),
                'time' => 'Dec 12, 2020'
            ],
            [
                'address' => $_SERVER['REMOTE_ADDR'],
                'machine_name' => gethostname(),
                'time' => 'Dec 12, 2020'
            ]
        ];

        return $this->ResponseComponent->success($data);
    }
}
