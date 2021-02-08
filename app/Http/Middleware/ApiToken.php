<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Component\ResponsesComponent;

class ApiToken
{
    protected $ResponseComponent;
    protected $allowApiWithoutToken;

    public function __construct()
    {
        $this->ResponseComponent = new ResponsesComponent();
        $this->allowApiWithoutToken = [
            'api/portfolio/token',
            'api/users/login'
        ];
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        // Identify if API dont need token
        if (in_array(request()->route()->uri, $this->allowApiWithoutToken)) {
            return $response;
        }
        // return error 401 if invalid token
        if (!Hash::check(config('const.API-TOKEN'), $request->Header('API-KEY'))) {
            return $this->ResponseComponent->authenticationFailed();
        }

        return $response;
    }
}
