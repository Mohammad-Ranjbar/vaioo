<?php

use App\Http\Controllers\PhoneOtpAuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/otp/mobile')->group(function () {
    Route::post('/request', [PhoneOtpAuthController::class, 'requestOtp']);
    Route::post('/verify', [PhoneOtpAuthController::class, 'verifyOtp']);
    Route::post('/resend', [PhoneOtpAuthController::class, 'resendOtp']);
});

