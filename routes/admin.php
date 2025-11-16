<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RepresentativeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as('admin.')->group(function () {
    Route::middleware('')->group(function () {
        Route::get('login', [AuthController::class, 'loginPage'])->name('login.page');
        Route::post('login', [AuthController::class, 'login'])->name('login');
    });

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/', [AuthController::class, 'check'])->name('check');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::resources([
            'policies' => PolicyController::class,
            'users' => UserController::class,
            'representatives' => RepresentativeController::class,
        ]);
    });

});

