<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController;

Route::get('/dashboard', [DashboardController::class, 'index'],)->name('dashboard');

// Route::get('/product', function () {return view('product');})->name('product');
//###################################################endregion
//######################################################
Route::post('/AddCart/{id}',[CartController::class,'AddCart']);
Route::post('/AddWishlist/{id}',[WishlistController::class,'AddWishlist']);


Route::get('/cart', [CartController::class,'cart']);
Route::get('/remove_cart/{id}', [CartController::class,'remove_cart']);

Route::get('/wishlist', [WishlistController::class,'wishlist']);
Route::get('/remove_wishlist/{id}', [WishlistController::class,'remove_wishlist']);
Route::post('/wishlist_order/{id}', [WishlistController::class,'wishlist_order']);

Route::post('/coupon', [CouponController::class,'coupon']);


Route::get('/stripe/{totalprice}',[CartController::class,'stripe']);
Route::post('stripe/{totalprice}',[CartController::class,'stripePost'])->name('stripe.post');


Route::get('/cash_order', [CartController::class,'cash_order']);




//############################################
//#####################################################

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