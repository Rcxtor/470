<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductUpdateController;
use App\Http\Controllers\UserViewController;
use App\Http\Controllers\ProductDetailsController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FeatureProductController;
use App\Http\Controllers\WelcomeController;

Route::get('/dashboard', [DashboardController::class, 'index'],)->name('dashboard');

// Route::get('/product_update/{name}', function () {return view('product_update');})->name('product_update');

Route::get('/product_update/{id}', [ProductUpdateController::class, 'edit'])->name('product_update');
Route::put('/product_update/{id}', [ProductUpdateController::class, 'update'])->name('product_update');
Route::delete('/product_delete/{id}', [ProductUpdateController::class, 'delete'])->name('product_delete');

Route::get('/user_view/{id}', [UserViewController::class, 'index'])->name('user_view');
Route::delete('/user_view/{id}', [UserViewController::class, 'delete'])->name('user_delete');
Route::put('/user_view/{id}', [UserViewController::class, 'update'])->name('user_view');

Route::get('/productDetails/{id}', [ProductDetailsController::class, 'index'])->name('productDetails');



// Route::get('/product_update', [DashboardController::class, 'index'],)->name('product_update');
// Route::get('/product/{id}/update', [ProductController::class, 'edit'])->name('products_update');


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

// coupoun
Route::post('/Addcoupon', [DashboardController::class,'Add'])->name('Addcoupon');
Route::delete('/Deletecoupon/{id}', [DashboardController::class, 'delete'])->name('Deletecoupon');

Route::get('/search', [DashboardController::class, 'search'])->name('search'); //search

Route::get('/search_user', [DashboardController::class, 'search_user'])->name('search_user'); //search


Route::post('/Add Product', [DashboardController::class, 'store'])->name('Add Product'); //testing

Route::put('/orderChange/{id}', [DashboardController::class, 'orderChange'])->name('orderChange'); //order


Route::get('/stripe/{totalprice}',[CartController::class,'stripe']);
Route::post('stripe/{totalprice}',[CartController::class,'stripePost'])->name('stripe.post');


Route::get('/cash_order', [CartController::class,'cash_order']);

Route::get('/send_email',[CartController::class,'index']);


// Featured;
Route::get('/featuredProduct',[FeatureProductController::class,'index'])->name('featuredProduct');
Route::post('/Addfeatured', [FeatureProductController::class, 'store'])->name('Addfeatured');
Route::delete('/DeleteFeatured/{id}', [FeatureProductController::class, 'delete'])->name('DeleteFeatured'); //

// GOOGLE LOGIN
Route::get('/auth/{provider}/redirect',[ProviderController::class, 'redirect']);
 
Route::get('/auth/{provider}/callback',[ProviderController::class, 'callback'] );

//############################################
//#####################################################

//Welcome
// Route::get('/', function () {return view('welcome');})->name('welcome');
Route::get('/',[WelcomeController::class,'index'])->name('welcome');


// Route::get('/search', [DashboardController::class, 'search'])->name('search'); //search

// Route::get('/search_user', [DashboardController::class, 'search_user'])->name('search_user'); //search


// Route::post('/Add Product', [DashboardController::class, 'store'])->name('Add Product'); //testing

Route::get('/products/{category}', [ProductController::class, 'showByCategory'])->name('products.category');
//filter
Route::get('/products/{category}',[ProductController::class, 'showByCategory'])->name('products.category');


// Profile
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::post('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/updateEmail', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';




// -----------------------DEFAULT CODES---------------------------------

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');