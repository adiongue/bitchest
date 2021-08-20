<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
//home page
Route::get('/', function () {
    return view('layouts.master');
});

// public
Route::post('/login', [AuthController::class, 'login']);

// admin
Route::group(['middleware' => ['auth:sanctum', 'admin']], function() {
    Route::post('/newUser', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
});

// admin and client
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
});
