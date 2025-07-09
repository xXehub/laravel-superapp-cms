<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard route (same as home for now)
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    
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

// Redirect root to dashboard if authenticated, otherwise to welcome
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});
