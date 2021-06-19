<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['Auth'] ], function () {
    Route::get('/', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');
    Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login.view');
    Route::post('/loginUser', [\App\Http\Controllers\Auth\AuthController::class, 'loginUser'])->name('loginUser');
    Route::get('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register'])->name('register.view');
    Route::post('/registerUser', [\App\Http\Controllers\Auth\AuthController::class, 'registerUser'])->name('registerUser');
});

Route::group(['middleware' => ['SendRequest'] ], function () {
    Route::post('/logoutUser', [\App\Http\Controllers\Auth\AuthController::class, 'logoutUser'])->name('logoutUser');
    Route::Resource('todos', \App\Http\Controllers\TodosController::class);
    Route::get('/home', function () {
        return view('admin.home');
    });
});
