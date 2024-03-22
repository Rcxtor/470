<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'],)->name('dashboard');

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard'); //testing
    
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