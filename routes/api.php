<?php

use App\Http\Controllers\VacancyController;
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




