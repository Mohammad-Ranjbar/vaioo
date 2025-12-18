<?php


use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ShipmentController;
use App\Http\Middleware\UserMidlleware;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->as('user.')->group(function () {

    Route::middleware('')->group(function () {
        Route::get('login', [AuthController::class, 'loginPage'])->name('login.page');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('register', [AuthController::class, 'registerPage'])->name('register.page');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });

    Route::middleware(UserMidlleware::class)->group(function () {
        Route::get('/', [AuthController::class, 'check'])->name('check');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        Route::resources([
            'shipments' => ShipmentController::class,
        ]);

    });

});

