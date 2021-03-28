<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, origin,Authorization");

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\ServiceCardController;
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
Route::get('hello',[HelloController::class, 'hello']);
Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class,'register']);
Route::post('forgot',[ForgotController::class, 'forgot']);
Route::post('reset',[ForgotController::class, 'reset']);
Route::post('addServiceCard',[ServiceCardController::class,'addServiceCard']);
Route::get('getAllServiceCards',[ServiceCardController::class,'getAllServiceCards']);
Route::get('user',[AuthController::class,'user'])->middleware('auth:api');
Route::get('getUsers',[UserController::class, 'getUsers']);
Route::post('removeServiceCard',[ServiceCardController::class,'removeServiceCard']);
