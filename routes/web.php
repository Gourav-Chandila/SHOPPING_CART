<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\RegisterationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\LogoutController;



Route::get('/', function () {
    return view('welcome');
});


// shows carousel on welcome page
// Route::get('/', [CarouselController::class, 'showCarouselImages']);
// Route::get('/', [ProductCategoriesController::class, 'showCategoriesCollection']);


// shows Carousel and Categories collection on Home page
Route::get('/', [WelcomeController::class, 'showCarouselAndCategoriesCollection']);


// shows login page
Route::get('/login', [LoginController::class, 'loginPage'])->name('login');
// post the data  login page
Route::post('/login', [LoginController::class, 'registerLogin']);

// route for register
Route::get('/register', [RegisterationController::class, 'index'])->name('register');
Route::post('/register', [RegisterationController::class, 'register']);

// route for forget_password
Route::get('/forget_password', [ForgetPasswordController::class, 'index'])->name('forget_password');
Route::post('/forget_password', [ForgetPasswordController::class, 'resetPassword']);


// frees all session variables when click on logout button
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');



