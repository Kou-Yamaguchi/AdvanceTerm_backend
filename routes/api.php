<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ShopsController;
use App\Http\Controllers\LikesController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/reservations', ReservationsController::class);
Route::post('/shops/reservation', 'ShopsController@reservation');
Route::post('/register', [RegisterController::class, 'post']);
Route::delete('/register', [RegisterController::class, 'delete']);
Route::post('/login',[LoginController::class, 'post']);
Route::post('/logout', [LogoutController::class, 'post']);
Route::get('/user', [UsersController::class, 'get']);
Route::apiResource('/shops', ShopsController::class);
Route::get('/shops/:shop_id', [ShopsController::class, 'get']);
Route::post('/like', [LikesController::class, 'post']);
Route::delete('/like', [LikesController::class, 'delete']);
//ใในใ
Route::get('/like', [LikesController::class, 'get']);