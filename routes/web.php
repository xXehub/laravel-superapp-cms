<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    
    // Pages management routes - require 'manage posts' permission
    Route::middleware(['permission:manage posts'])->group(function () {
        Route::get('/admin/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/admin/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/admin/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/admin/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/admin/pages/{page}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/admin/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
    });
    
    // Users routes - require 'manage users' permission
    Route::middleware(['permission:manage users'])->group(function () {
        Route::get('/users', function () {
            return view('users.index');
        })->name('users.index');
        
        Route::get('/users/create', function () {
            return view('users.create');
        })->name('users.create');
    });
    
    // Posts routes - require 'view posts' permission for index, 'manage posts' for create
    Route::middleware(['permission:view posts'])->group(function () {
        Route::get('/posts', function () {
            return view('posts.index');
        })->name('posts.index');
    });
    
    Route::middleware(['permission:manage posts'])->group(function () {
        Route::get('/posts/create', function () {
            return view('posts.create');
        })->name('posts.create');
    });
    
    // Settings route - admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/settings', function () {
            return view('settings.index');
        })->name('settings.index');
    });
});

// Catch-all route for dynamic pages (must be last)
Route::get('/{slug}', [PageController::class, 'show'])->where('slug', '[a-zA-Z0-9\-_]+');
