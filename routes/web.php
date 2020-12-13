<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevicesController;
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

Route::middleware(IsAuth::class)->prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::post('profile', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('profile', [DashboardController::class, 'delete'])->name('dashboard.delete');
    Route::get('token', [DashboardController::class, 'token'])->name('dashboard.token');

    Route::prefix('devices')->group(function () {
        Route::get('/', [DevicesController::class, 'index'])->name('dashboard.devices');
        Route::get('get', [DevicesController::class, 'devices'])
            ->middleware('throttle:120')
            ->name('dashboard.api.devices');
        Route::get('{device}', [DevicesController::class, 'show'])
            ->name('dashboard.device');
        Route::post('{device}', [DevicesController::class, 'update'])
            ->name('dashboard.device.update');

        Route::get('{device}/chart-work', [ChartController::class, 'workChart']);
        Route::get('{device}/chart-watt', [ChartController::class, 'wattChart']);
    });
});
