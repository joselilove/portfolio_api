<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Component\ResponsesComponent;

class ApiToken
{
    protected $ResponseComponent;

    public function __construct()
    {
        $this->ResponseComponent = new ResponsesComponent();
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
        if (!Hash::check(config('const.API-TOKEN'), $request->Header('API-KEY'))) {
            return $this->ResponseComponent->success();
        }

        return $next($request);
    }
}
