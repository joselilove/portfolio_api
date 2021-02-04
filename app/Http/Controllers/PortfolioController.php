<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Component\ResponsesComponent;

class PortfolioController extends Controller
{
    protected $ResponseComponent;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->ResponseComponent = new ResponsesComponent();
    }

    public function getToken()
    {
        $newToken['token'] = Hash::make(config('const.API-TOKEN'));

        return $this->ResponseComponent->success($newToken);
    }

    /**
     * insertAccessLogs
     */
    public function insertAccessLogs()
    {
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
