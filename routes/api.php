<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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


Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::middleware('auth:api')->group(function () {
    Route::resource('/users', 'UsersController');
});
Route::middleware('auth:api')->group(function () {
    Route::resource('/todos', 'TodoController');
});
Route::middleware('auth:api')->post('/todos/{todo}/status', 'TodoController@updateStatus');
Route::middleware('auth:api')->post('/todos/{todo}/user', 'TodoController@updateUser');
