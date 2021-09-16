<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'jwt.auth', 'prefix' => 'v1'], function ($router) {
    /**
     * Auth
     */
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);
    Route::post('auth/refresh', [AuthController::class, 'refresh']);
    
    /**
     * User
     */
    Route::get('show', [UserController::class, 'show']);
    // Route::get('user', [UserController::class, 'index']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::put('user/senha/{id}', [UserController::class, 'updatePass']);

    /**
     * Templates
     */
    Route::post('template', [TemplateController::class, 'store']);
    Route::put('template/{id}', [TemplateController::class, 'update']);
});

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('user', [UserController::class, 'store']);