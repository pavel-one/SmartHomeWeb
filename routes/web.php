<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\IsAuth;
use App\Http\Middleware\NonAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('auth.index');
})->name('index');

Route::prefix('auth')
    ->middleware(NonAuth::class)
    ->group(function () {
        Route::get('/', [AuthController::class, 'login'])->name('auth.index');
        Route::get('register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('auth', [AuthController::class, 'auth'])->name('auth');
    });

Route::get('auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(IsAuth::class)
    ->prefix('/dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });
