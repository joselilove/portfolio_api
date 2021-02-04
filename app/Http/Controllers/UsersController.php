<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Component\ResponsesComponent;

class UsersController extends Controller
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
     * login
     */
    public function login()
    {
        # code...
    }

    /**
     * register
     */
    public function register()
    {
        # code...
    }

    /**
     * logout
     */
    public function logout()
    {
        # code...
    }

    /**
     * update
     */
    public function update()
    {
        # code...
    }
}
