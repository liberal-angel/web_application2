<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todo',[TodoController::class, 'index']);
Route::post('/create',[TodoController::class, 'create']);
Route::post('/update/{id}',[TodoController::class, 'update']);
Route::post('/delete/{id}',[TodoController::class, 'delete']);