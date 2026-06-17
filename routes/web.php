<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('admin.login'));

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');

    Route::middleware('auth')->group(function () {
        Route::post('/logout',   [AdminController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/projects',  [AdminController::class, 'projects'])->name('projects');
        Route::get('/tasks',     [AdminController::class, 'tasks'])->name('tasks');
        Route::get('/users',     [AdminController::class, 'users'])->name('users');
    });
});