<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Panel\PanelController;

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authentication routes
Auth::routes();

// Dashboard routes (both /home and /dashboard point to same controller)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Panel Admin Routes - Protected by auth, admin role, and dynamic menu access
Route::middleware(['auth', 'role:admin', 'dynamic_menu_access'])->prefix('panel')->name('panel.')->group(function () {
    Route::get('/{slug}', [PanelController::class, 'dynamicRoute'])
        ->where('slug', '[a-zA-Z0-9\-_]+')
        ->name('dynamic');
});

// Dynamic pages - Check access via middleware, show public or menu-protected pages
Route::middleware(['dynamic_menu_access'])->get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[a-zA-Z0-9\-_/]+')
    ->name('page.show');
