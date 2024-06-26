<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// vacancies
Route::get('/vacancies', [VacancyController::class, 'index']);
Route::get('/vacancies/newest', [VacancyController::class, 'getThree']);
Route::get('/vacancies/{id}', [VacancyController::class, 'getSingle']);
Route::post('/vacancies/add', [VacancyController::class, 'store']);
Route::post('/vacancies/update/{id}', [VacancyController::class, 'update']);
Route::delete('/vacancies/delete/{id}', [VacancyController::class, 'delete']);



// news
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/newest', [NewsController::class, 'getThree']);
Route::get('/news/{id}', [NewsController::class, 'getSingle']);
Route::post('/news/add', [NewsController::class, 'store']);
Route::post('/news/update/{id}', [NewsController::class, 'update']);
Route::delete('/news/delete/{id}', [NewsController::class, 'delete']);



//applications
Route::get('/applications', [ApplicationsController::class, 'index']);
Route::post('/applications/add', [ApplicationsController::class, 'store']);
Route::post('/applications/changeStatus/{id}', [ApplicationsController::class, 'changeStatus']);


//login
Route::post('/login/enter', [LoginController::class, 'enter']);
Route::get('/admin/{id}', [LoginController::class, 'index']);

//users
Route::get('/users', [UsersController::class, 'index']);
Route::post('/users/add', [UsersController::class, 'store']);
Route::delete('/users/delete/{id}', [UsersController::class, 'delete']);
Route::post('/users/update/{id}', [UsersController::class, 'update']);
Route::post('/users/changePassword/{id}', [UsersController::class, 'changePassword']);