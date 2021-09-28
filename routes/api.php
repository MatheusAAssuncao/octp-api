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
    Route::post('auth/refresh', [AuthController::class, 'refresh']); // atualizar token

    /**
     * User
     */
    Route::put('user/pass', [UserController::class, 'updatePass']); // alterar senha
    Route::get('user', [UserController::class, 'show']); // get usuario by id
    Route::put('user', [UserController::class, 'update']); // alterar dados de usuario
    Route::post('user/photo', [UserController::class, 'savePhoto']); // salvar foto do usuario
    Route::delete('user/photo', [UserController::class, 'removePhoto']); // remover foto do usuario
    Route::post('user/term', [UserController::class, 'saveTerm']); // salvar termo de uso do usuario
    Route::delete('user/term', [UserController::class, 'removeTerm']); // remover termo de uso do usuario

    /**
     * Templates
     */
    // Route::post('template', [TemplateController::class, 'store']); // cadastrar template
    // Route::put('template/{id}', [TemplateController::class, 'update']); // alterar template
});

Route::post('auth/login', [AuthController::class, 'login']); // login
Route::post('user', [UserController::class, 'store']); // cadastrar novo usuario
Route::post('user/forgot-pass', [UserController::class, 'forgotPass']); // reset de senha