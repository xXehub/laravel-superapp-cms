<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DynamicController;

// Authentication routes (Laravel UI)
Auth::routes();

// Dynamic routes - handle all requests through single controller
Route::match(['GET', 'POST', 'PUT', 'DELETE'], '/{slug?}/{id?}', [DynamicController::class, 'handleDynamicRoute'])
    ->where('slug', '.*')
    ->where('id', '[0-9]+')
    ->middleware(['dynamic_menu_access'])
    ->name('dynamic');

// Named route helpers for backward compatibility
Route::redirect('/home', '/profile')->name('home');
Route::get('/', [DynamicController::class, 'handleDynamicRoute'])->name('welcome');
Route::get('/profile', [DynamicController::class, 'handleDynamicRoute'])->name('profile');
