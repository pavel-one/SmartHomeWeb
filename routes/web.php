<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteController;
use App\Http\Middleware\IsAuth;
use App\Http\Middleware\NonAuth;
use Illuminate\Support\Facades\Route;

Route::middleware(NonAuth::class)
    ->get(
        '/',
        [SiteController::class, 'index']
    )
    ->name('index');

Route::middleware(IsAuth::class)
    ->prefix('/dashboard')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    });
