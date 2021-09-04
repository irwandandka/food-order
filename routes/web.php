<?php

use App\Http\Controllers\{AdminController,HomeController};
use App\Http\Livewire\{Admin,HomeMenu};
use Illuminate\Support\Facades\{Auth,Route};

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Authentication
Auth::routes();

// Home Page & Admin Dashboard
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'checkRole'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('/admin', Admin::class);
        Route::get('edit/{menu}', [AdminController::class, 'edit'])->name('edit.menu');
        Route::get('users', [AdminController::class, 'user'])->name('users');
        Route::get('orders', [AdminController::class, 'order'])->name('orders');
    });
});
