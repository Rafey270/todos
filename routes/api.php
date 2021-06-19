<?php

use Illuminate\Http\Request;
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

Route::get('email/verify/{id}', [\App\Http\Controllers\Api\Auth\VerificationController::class, 'verify'])->name('user.emailVerify');

Route::post('register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register'])->name('user.register');
Route::post('login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login'])->name('user.login');

Route::group(['middleware' => 'auth:api' ], function () {
    Route::post('logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout'])->name('user.logout');
    Route::apiResource('todos', \App\Http\Controllers\Api\TodosController::class);
});
