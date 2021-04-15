<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, origin,Authorization");

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingServiceController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceCardController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
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

//authenticate controller
Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class,'register']);
Route::get('user',[AuthController::class,'user'])->middleware('auth:api');

//forgot controller
Route::post('forgot',[ForgotController::class, 'forgot']);
Route::post('reset',[ForgotController::class, 'reset']);

//service card controller
Route::get('getAllServiceCards',[ServiceCardController::class,'getAllServiceCards']);
Route::post('addServiceCard',[ServiceCardController::class,'addServiceCard']);
Route::post('removeServiceCard',[ServiceCardController::class,'removeServiceCard']);
Route::post('editServiceCard', [ServiceCardController::class, 'editServiceCard']);

//testimonial controller
Route::post('addTestimonial', [TestimonialController::class, 'addTestimonial']);
Route::post('getAllTestimonials', [TestimonialController::class, 'getAllTestimonials']);
Route::post('toggleVisibility', [TestimonialController::class, 'toggleVisibility']);

//equipment controller
Route::post('addEquipment',[EquipmentController::class, 'addEquipment']);
Route::post('getAllEquipment',[EquipmentController::class, 'getAllEquipment']);
Route::post('deleteEquipment',[EquipmentController::class, 'deleteEquipment']);

//user controller
Route::get('getAllUsers',[UserController::class, 'getAllUsers']);
Route::post('updateUserInfo', [UserController::class, 'updateUserInfo']);
Route::post('resetPassword', [UserController::class, 'resetPassword']);
Route::post('deleteUser', [UserController::class, 'deleteUser']);
Route::post('toggleBlocked', [UserController::class, 'toggleBlocked']);

//project controller
Route::post('addProject',[ProjectController::class, 'addProject']);
Route::post('getAllProjects',[ProjectController::class, 'getAllProjects']);
Route::post('getUpcomingProjects',[ProjectController::class, 'getUpcomingProjects']);
Route::post('alterComplete',[ProjectController::class, 'alterComplete']);
Route::post('alterInvoiceStatus',[ProjectController::class, 'alterInvoiceStatus']);
Route::post('deleteProject',[ProjectController::class, 'deleteProject']);
Route::post('printProjects',[ProjectController::class, 'printProjects']);
Route::post('sendInvoice',[ProjectController::class,'sendInvoice']);

//booking service controller
Route::post('bookService',[BookingServiceController::class, 'bookService']);

//contact us controller
Route::post('contactUs',[ContactUsController::class,'contactUs']);

