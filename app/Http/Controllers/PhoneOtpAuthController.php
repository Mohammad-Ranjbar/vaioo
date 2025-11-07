<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Random\RandomException;

class PhoneOtpAuthController extends Controller
{


    public function __construct(private readonly OtpService $otpService)
    {

    }

    /**
     * @throws ValidationException
     */
    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {

        $validatedData = $request->validated();
        $phone = $validatedData['phone'];
        $key = "otp_verify:$phone";

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'otp' => "Too many attempts. Try again in $seconds seconds.",
            ]);
        }

        $user = $this->otpService->verifyOtp($phone, $validatedData['otp']);

        if (!$user) {
            RateLimiter::hit($key, 600);
            throw ValidationException::withMessages([
                'otp' => 'Invalid or expired OTP.',
            ]);
        }

        RateLimiter::clear($key);

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Login

        Auth::login($user);

        Log::info('Mobile OTP Login', [
            'user_id' => $user->getAttribute('id'),
            'phone' => $phone,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        return response()->json([
            'message' => 'Login successful.',
            'user' => $user->only('id', 'name', 'phone'),
            'redirect' => route('dashboard'),
        ]);
    }

    /**
     * @throws ValidationException
     * @throws RandomException
     */
    public function resendOtp(PhoneOtpRequest $request): JsonResponse
    {
        return $this->requestOtp($request);
    }

    // Optional: Resend

    /**
     * @throws ValidationException
     * @throws RandomException
     */
    public function requestOtp(PhoneOtpRequest $request): JsonResponse
    {

        $phone = $request->validated()['phone'];
        $key = "otp_request:$phone";

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'phone' => "Too many requests. Try again in $seconds seconds.",
            ]);
        }

        $user = User::query()->where('phone', $phone)->firstOrFail();

        $response = $this->otpService->sendOtpToPhone($phone, $user);

        RateLimiter::hit($key, 61);

        return response()->json($response);
    }
}
