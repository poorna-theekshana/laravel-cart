<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Admin Access Routes
Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}/delete', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/viewuser', [UserController::class, 'viewuser'])->name('user.viewuser');

});

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::delete('/cart', [ProductController::class, 'delete'])->name('cart.delete');

//User Access Routes
Route::group(['middleware' => 'isUser'], function () {
    
});

//Common Access Routes
Route::group([], function () {
    
    Route::get('/', [ProductController::class, 'welcomeproducts'])->name('welcome');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();

// Route::delete('/remove-from-cart/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');

// // Route to remove a product from the cart
// Route::delete('/remove-from-cart/{cartItem}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');

// // Route to checkout
// Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
