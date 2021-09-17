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
    Route::post('auth/logout', [AuthController::class, 'logout']); // logout
    Route::get('auth/me', [AuthController::class, 'me']); // informar usuario by token
    Route::post('auth/refresh', [AuthController::class, 'refresh']); // atualizar token
    
    /**
     * User
     */
    Route::get('show', [UserController::class, 'show']); // get usuario by id
    // Route::get('user', [UserController::class, 'index']);
    Route::put('user/{id}', [UserController::class, 'update']); // alterar dados de usuario
    Route::put('user/pass/{id}', [UserController::class, 'updatePass']); // alterar senha
    Route::post('user/reset-pass', [UserController::class, 'resetPass']); // reset de senha

    /**
     * Templates
     */
    Route::post('template', [TemplateController::class, 'store']); // cadastrar template
    Route::put('template/{id}', [TemplateController::class, 'update']); // alterar template
});

Route::post('auth/login', [AuthController::class, 'login']); // login
Route::post('user', [UserController::class, 'store']); // cadastrar novo usuario