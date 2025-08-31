<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

// Change this line from 'home' to 'dashboard'
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Brand Routes
    Route::resource('brands', BrandController::class);
    
    // Category Routes
    Route::resource('categories', CategoryController::class);
    
    // Item Routes
    Route::resource('items', ItemController::class);
});