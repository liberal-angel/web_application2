<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('auth')->group(function () {
    Route::get('/',[TodoController::class, 'index']);
    Route::post('/create',[TodoController::class, 'create']);
    Route::post('/update/{id}/{task}',[TodoController::class, 'update']);
    Route::post('/delete/{id}',[TodoController::class, 'delete']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('search',[TodoController::class, 'search']);
    Route::post('search',[TodoController::class, 'search_post']);
    Route::post('/search_update/{id}/{task}',[TodoController::class, 'search_update']);
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
