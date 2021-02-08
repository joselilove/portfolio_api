<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Component\ResponsesComponent;
use App\Http\Form\CustomValidator;

class UsersController extends Controller
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

    /**
     * login
     */
    public function login(Request $request)
    {
        $data['token'] = Hash::make(config('const.API-TOKEN'));

        $validatationMessaeg = $this->CustomValidator->validate($request, 'RegisterUserForm');

        if (!($validatationMessaeg === false)) {
            return $validatationMessaeg;
        }

        return $this->ResponseComponent->success($data);
    }

    /**
     * register
     */
    public function register(Request $request)
    {
        $validatationMessaeg = $this->CustomValidator->validate($request, 'RegisterUserForm');

        if (!($validatationMessaeg === false)) {
            return $validatationMessaeg;
        }

        return $this->ResponseComponent->success();
    }

    /**
     * logout
     */
    public function logout()
    {
        return $this->ResponseComponent->success();
    }

    /**
     * update
     */
    public function updateUser(Request $request)
    {
        $validatationMessaeg = $this->CustomValidator->validate($request, 'UpdateUserForm');

        if (!($validatationMessaeg === false)) {
            return $validatationMessaeg;
        }

        return $this->ResponseComponent->success();
    }
}
