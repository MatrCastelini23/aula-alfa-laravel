<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])
        ->middleware('throttle:login')->name('login.attempt');
});

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('store', [UserController::class, 'create'])->name('users.store');

Route::middleware('auth')->group(function () {
    Route::get('/', fn () => view('home')); // troque pela view inicial existente
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'register'])->name('users.create');
    Route::get('user/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('user/{user}/resetForm', [UserController::class, 'resetForm'])->name('users.resetForm');
    Route::post('user/{user}/resetForm', [UserController::class, 'resetPassword'])->name('users.reset');
});
