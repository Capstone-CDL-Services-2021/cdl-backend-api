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
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
