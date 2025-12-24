<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PhoneOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\User;
use App\Services\OtpVerificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Random\RandomException;

class UserOtpAuthController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function verifyOtp(VerifyOtpRequest $request): true
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


        $verification = OtpVerificationService::verifyOtp($phone, $validatedData['otp']);

        if (!$verification) {
            RateLimiter::hit($key, 600);
            throw ValidationException::withMessages([
                'otp' => trans('auth.invalid_code'),
            ]);
        }

        RateLimiter::clear($key);

        $request->session()->regenerate();

        $entity = $verification->getAttribute('authenticatable');

        Auth::login($entity);

        return true;
    }

    public function resendOtp($phone): JsonResponse
    {
        return $this->requestOtp($phone);
    }

    /**
     * @throws ValidationException
     * @throws RandomException
     */
    public function requestOtp(PhoneOtpRequest $request): JsonResponse
    {
        $mobile = $request->validated()['mobile'];
        $key = "otp_request:$mobile";

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'phone' => "Too many requests. Try again in $seconds seconds.",
            ]);
        }

        $user = User::query()->where('mobile', $mobile)->firstOrFail();
        $params = [
            'model_type' => User::class,
            'model_id' => $user->getAttribute('id')
        ];
        $response = OtpVerificationService::send($user->getAttribute('mobile'), '####', $params);

        RateLimiter::hit($key, 61);

        return response()->json($response);
    }
}
