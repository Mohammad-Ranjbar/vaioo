<?php


use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\ShipmentController;
use App\Http\Controllers\User\UserOtpAuthController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Middleware\UserMidlleware;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->as('user.')->group(function () {

    Route::middleware('')->group(function () {
        Route::post('/request', [UserOtpAuthController::class, 'requestOtp']);
        Route::post('/verify', [UserOtpAuthController::class, 'verifyOtp']);
        Route::post('/resend', [UserOtpAuthController::class, 'resendOtp']);
        Route::get('login', [AuthController::class, 'loginPage'])->name('login.page');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('register', [AuthController::class, 'registerPage'])->name('register.page');
        Route::post('register', [AuthController::class, 'register'])->name('register');
    });

    Route::middleware(UserMidlleware::class)->group(function () {
        Route::get('/', [AuthController::class, 'check'])->name('check');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', DashboardController::class)->name('dashboard');
        Route::get('/profile', [UserProfileController::class, 'getProfile'])->name('profile');
        Route::put('/set-profile', [UserProfileController::class, 'setProfile'])->name('set-profile');

        Route::as('messages.')->prefix('messages')->group(function () {
            Route::get('/', [MessageController::class, 'index'])->name('index');
            Route::get('/{id}', [MessageController::class, 'show'])->name('show');
            Route::post('/{id}/reply', [MessageController::class, 'storeReply'])->name('reply.store');
        });


        Route::get('/password', [UserProfileController::class, 'getPassword'])->name('password');
        Route::put('/set-password', [UserProfileController::class, 'setPassword'])->name('set-password');
        Route::resources([
            'shipments' => ShipmentController::class,
        ]);

    });

});

