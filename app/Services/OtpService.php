<?php

namespace App\Services;

use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Random\RandomException;

class OtpService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    /**
     * @throws ValidationException
     * @throws RandomException
     */
    public function sendOtpToPhone(string $phone, User $user): array
    {
        $phone = $this->normalizePhone($phone);
        $this->validatePhoneExists($phone);

        // Clean old OTPs
        OtpVerification::query()->where('identifier', $phone)
            ->where('channel', 'sms')
            ->where(function ($q) {
                $q->where('used', true)->orWhere('expires_at', '<', now());
            })
            ->delete();

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        OtpVerification::query()->create([
            'authenticatable_type' => User::class,
            'authenticatable_id' => $user->id,
            'channel' => 'sms',
            'identifier' => $phone,
            'otp_hash' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5),
        ]);

        $this->sendSms($phone, "Your login OTP is: {$otp}. Valid for 5 minutes.");

        return [
            'message' => 'OTP sent to your phone.',
            'expires_in' => 300
        ];
    }

    public function verifyOtp(string $phone, string $otp): ?User
    {
        $phone = $this->normalizePhone($phone);

        $record = OtpVerification::query()->where('identifier', $phone)
            ->where('channel', 'sms')
            ->where('used', false)
            ->latest()
            ->first();

        if (!$record || $record->isExpired()) {
            return null;
        }

        if (!Hash::check($otp, $record->otp_hash)) {
            return null;
        }

        $record->markAsUsed();
        return $record->authenticatable;
    }

    protected function sendSms(string $to, string $message): void
    {
        $this->twilio->messages->create($to, [
            'from' => config('services.twilio.from'),
            'body' => $message
        ]);
    }

    protected function normalizePhone(string $phone): string
    {
        // Remove all non-digits
        $phone = preg_replace('/\D/', '', $phone);
        // Add + prefix if missing
        return $phone[0] === '+' ? $phone : "+{$phone}";
    }

    /**
     * @throws ValidationException
     */
    protected function validatePhoneExists(string $phone): void
    {
        $exists = User::query()->where('phone', $phone)->exists();
        if (!$exists) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'phone' => 'This phone number is not registered.',
            ]);
        }
    }
}
