<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PolicyController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('')->group(function () {
        Route::get('login',[AuthController::class,'loginPage'])->name('login.page');
        Route::post('login',[AuthController::class,'login'])->name('login');
    });
    Route::get('dashboard',DashboardController::class)->name('dashboard');
    Route::resource('policies', PolicyController::class);
});

