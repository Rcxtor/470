<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;


Route::get('/dashboard', [DashboardController::class, 'index'],)->name('dashboard');

// Route::get('/product', function () {return view('product');})->name('product');
Route::get('/cart', function () {return view('cart');})->name('cart');
Route::get('/wishlist', function () {return view('wishlist');})->name('wishlist');


Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('/search', [DashboardController::class, 'search'])->name('search'); //search

Route::get('/search_user', [DashboardController::class, 'search_user'])->name('search_user'); //search


Route::post('/Add Product', [DashboardController::class, 'store'])->name('Add Product'); //testing

Route::get('/products/{category}', [ProductController::class, 'showByCategory'])->name('products.category');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




// -----------------------DEFAULT CODES---------------------------------

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');