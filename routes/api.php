<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Públicas
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [UserController::class, 'create'])->name('users.store');

// Autenticadas (qualquer usuário logado)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

// Somente administradores
Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'register'])->name('users.create');
        Route::get('user/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('user/{user}/resetForm', [UserController::class, 'resetForm'])->name('users.resetForm');
        Route::post('user/{user}/resetForm', [UserController::class, 'resetPassword'])->name('users.reset');
    });
