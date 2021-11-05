<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MuscleGroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TrainController;
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

    /**
     * Cards
     */
    Route::get('card', [CardController::class, 'index']); // listar os modelos de cards cadastrados
    Route::get('card/{id}', [CardController::class, 'getCardFromStudent']); // listar os cards cadastrados a um aluno
    Route::post('card', [CardController::class, 'create']); // cadastrar uma ficha a um aluno
    Route::put('card', [CardController::class, 'update']); // alterar dados da ficha
    Route::delete('card/{id}', [CardController::class, 'destroy']); // remove uma ficha modelo

    /**
     * Train
     */
    Route::post('train', [TrainController::class, 'create']); // cadastrar um treino a um aluno
    Route::delete('train/{id}', [TrainController::class, 'destroy']); // remover treino

    /**
     * Exercise
     */
    Route::get('exercise', [ExerciseController::class, 'index']); // listar exercícios
    Route::get('exercise/group-type', [ExerciseController::class, 'showGroupType']); // listar tipos de exercícios
    Route::get('exercise/repetition-type', [ExerciseController::class, 'showRepetitionType']); // listar tipos de repetições
    Route::get('exercise/charge-type', [ExerciseController::class, 'showChargeType']); // listar tipos de pesos

    /**
     * Equipments
     */
    Route::get('equipment', [EquipmentController::class, 'index']); // listar equipamentos

    /**
     * Muscle Groups
     */
    Route::get('muscle-group', [MuscleGroupController::class, 'index']); // listar grupos musculares
});

Route::post('auth/login', [AuthController::class, 'login']); // login
Route::post('user', [UserController::class, 'store']); // cadastrar novo usuario
Route::post('user/forgot-pass', [UserController::class, 'forgotPass']); // reset de senha