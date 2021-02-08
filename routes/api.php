<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Component\ResponsesComponent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('portfolio')->group(function () {
    // Get new token
    Route::get('/token', [PortfolioController::class, 'getToken']);
    // Insert access logs when users visit the portfolio page
    Route::post('/access/logs', [PortfolioController::class, 'insertAccessLogs']);
    // View access logs
    Route::get('/access/logs', [PortfolioController::class, 'getAccessLogs']);
});

Route::prefix('users')->group(function () {
    // Login
    Route::post('/login', [UsersController::class, 'login']);
    // Logout
    Route::post('/logout', [UsersController::class, 'logout']);
    // Register
    Route::post('/register', [UsersController::class, 'register']);
    // Update User
    Route::post('/update', [UsersController::class, 'updateUser']);
});

Route::fallback(function () {
    $this->ResponseComponent = new ResponsesComponent();
    return $this->ResponseComponent->notFound();
});