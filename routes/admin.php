<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PolicyController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::resource('policies', PolicyController::class);
});

