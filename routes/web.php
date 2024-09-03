<?php  

use App\Facades\Route;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\UserController;

Route::get('/', HomeController::class, 'index');
Route::get('/register', AuthController::class, 'showRegister');
Route::post('/register', AuthController::class, 'register');
Route::get('/login', AuthController::class, 'showLogin');
Route::post('/login', AuthController::class, 'login');
Route::get('/logout', AuthController::class, 'logout');
Route::get('/UserHome', UserController::class, 'index');
Route::get('/home', HomeController::class, 'index');    


Route::dispatch();