<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\RegisterationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ShowProductsController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

// shows Carousel and Categories collection on Home page
Route::get('/', [WelcomeController::class, 'showCarouselAndCategoriesCollection']);

//shows categories page
Route::get('/categories', [CategoriesController::class, 'showCategories'])->name('categories');

// shows login page
Route::get('/login', [LoginController::class, 'loginPage'])->name('login');

// post the data  login page
Route::post('/login', [LoginController::class, 'registerLogin']);

// route for register
Route::get('/register', [RegisterationController::class, 'index'])->name('register');
Route::post('/register', [RegisterationController::class, 'register']);

// route for forget_password
Route::get('/forget_password', [ForgetPasswordController::class, 'index'])->name('forget_password');

// frees all session variables when click on logout button
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

//Route to show products 
Route::get('/show_products', [ShowProductsController::class, 'productsData'])->name('show_products');

//Routes for cart page
Route::get('/cart', [CartController::class, 'updateCart'])->name('cart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');


Route::get('/remove-item', [CartController::class, 'removeItem'])->name('remove.item');
