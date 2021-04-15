<?php
/**
 *******************************************
 *                                         *
 * Application: Back-end of CDL_Services  *
 *                                         *
 * Author: Alejandro Pena Canelon          *
 *         Daniel Tran                     *
 *         David Do                        *
 *         Jimmy Lam                       *
 *         Jordan Banh                     *
 *         Justin Serrano                  *
 *                                         *
 * Date: April 16, 2021                    *
 *                                         *
 ******************************************* **/
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

Route::get('/', function () {
    return view('welcome');
});
