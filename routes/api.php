<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\UserController;
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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// public
Route::post('/login', [AuthController::class, 'login']);

Route::post('/newUser', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'get']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);

// currencies
Route::get('/currencies', [CurrencyController::class, 'index']);
Route::get('/currency/{id}', [CurrencyController::class, 'getCurrencyById']);
Route::post('/currency', [CurrencyController::class, 'store']);


// admin
/*Route::group(['middleware' => ['auth:sanctum', 'admin']], function() {
    Route::post('/newUser', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
});*/

// admin and client
/*Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
});*/
