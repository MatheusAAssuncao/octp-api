<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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
    Route::post('user/photo', [UserController::class, 'savePhoto']); // salvar foto do usuario
    Route::delete('user/photo', [UserController::class, 'removePhoto']); // remover foto do usuario

    /**
     * Teacher
     */
    Route::put('teacher', [TeacherController::class, 'update']); // alterar dados do professor
    Route::post('teacher/new-student', [TeacherController::class, 'newStudent']); // convidar um novo aluno
    Route::put('teacher/edit-student', [TeacherController::class, 'updateStudent']); // editar um aluno
    Route::get('teacher/show-students', [TeacherController::class, 'index']); // listar os alunos vinculados ao professor

    /**
     * Student
     */
    Route::post('student/anamnesis', [StudentController::class, 'uploadAnamnesis']); // upload de anamnese

    /**
     * File
     */
    Route::get('file', [FileController::class, 'index']); // listar os documentos cadastrados
    Route::post('file', [FileController::class, 'store']); // cadastrar documento
    Route::delete('file/{id}', [FileController::class, 'destroy']); // remover documento
    Route::get('file/category', [FileController::class, 'showCategory']); // listar categorias
});

Route::post('auth/login', [AuthController::class, 'login']); // login
Route::post('user', [UserController::class, 'store']); // cadastrar novo usuario
Route::post('user/forgot-pass', [UserController::class, 'forgotPass']); // reset de senha