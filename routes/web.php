<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

Route::prefix('{lang?}')->middleware('locale')->group(function($lang) {
    Route::middleware('isAdmin')->group(function () {
        // Only admin can access these routes
        // GET
        Route::get('/role/update/{id}', [AdminController::class, 'updateRoleForm'])->name('role.form');
        Route::get('/maintain', [AdminController::class, 'index'])->name('account.maintenance');
    });

    Route::middleware('auth')->group(function () {
        // Any authenticated user can access these routes
        // GET
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/cart', [OrderController::class, 'index'])->name('cart');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/item/{id}', [ItemController::class, 'detail'])->name('item.detail');
    });

    Route::middleware('guest')->group(function () {
        // Only guest can access these routes, authenticated users will be redirected to home
        // GET
        Route::get('/', function () { return view('index'); })->name('welcome');
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
    });
});

Route::middleware('isAdmin')->group(function () {
    // Only admin can access these routes
    // PATCH
    Route::patch('/role/update/{id}', [AdminController::class, 'updateRole'])->name('role.update');
    // DELETE
    Route::delete('/account/{id}', [AdminController::class, 'deleteAccount'])->name('account.delete');
});

Route::middleware('auth')->group(function () {
    // Any authenticated user can access these routes
    // POST
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/cart', [OrderController::class, 'store'])->name('cart.store');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');
    // PATCH
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // DELETE
    Route::delete('/cart/{id}', [OrderController::class, 'delete'])->name('cart.delete');
});

Route::middleware('guest')->group(function () {
    // Only guest can access these routes, authenticated users will be redirected to home
    // POST
    Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.login');
    Route::post('/register', [RegisterController::class, 'store'])->name('auth.register');
});
