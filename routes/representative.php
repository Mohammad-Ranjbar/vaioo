<?php


use App\Http\Controllers\Representative\AuthController;
use App\Http\Controllers\Representative\DashboardController;
use App\Http\Middleware\RepresentativeMidlleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Representative\TripController;


Route::prefix('representative')->as('representative.')->group(function () {

    Route::middleware('')->group(function () {
        Route::get('login', [AuthController::class, 'loginPage'])->name('login.page');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('register', [AuthController::class, 'registerPage'])->name('register.page');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });

    Route::middleware(RepresentativeMidlleware::class)->group(function () {
        Route::get('/', [AuthController::class, 'check'])->name('check');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::resources([
            'trips' => TripController::class,
        ]);

    });

});

