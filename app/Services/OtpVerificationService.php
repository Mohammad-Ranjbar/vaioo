<?php

namespace App\Services;

use App\Models\Verification;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Random\RandomException;

readonly class OtpVerificationService
{
    /**
     * @throws RandomException
     */
    public static function send( string $mobile,  string $template,  array $params): array
    {
        try {
            $phone = $mobile;

            Verification::query()->where('identifier', $phone)
                ->where('channel', 'sms')
                ->where(function ($q) {
                    $q->where('used', true)->orWhere('expires_at', '<', now());
                })
                ->delete();

            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $expireTime = now()->addMinutes(2);

            Verification::query()->create([
                'authenticatable_type' => $params['model_type'],
                'authenticatable_id' => $params['model_id'],
                'channel' => Verification::CHANNELS[0],
                'identifier' => $phone,
                'otp_hash' => Hash::make($otp),
                'expires_at' => $expireTime,
            ]);

            unset($params['model_type'],$params['model_id']);

            $params['code'] = $otp;

            SmsService::sendSms($mobile, $template, $params);

            return [
                'message' => trans('messages.verification_sms_sent'),
                'expires_in' => $expireTime->diffInSeconds(now()),
            ];
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return [
                'message' => $exception->getMessage(),
                'expires_in' => 0,
            ];
        }

    }


    public static function verifyOtp(string $phone, string $otp): false|Verification
    {

        $record = Verification::query()->where('identifier', $phone)
            ->where('channel', 'sms')
            ->where('used', false)
            ->latest()
            ->first();

        if (!$record || $record->isExpired()) {
            return false;
        }

        if (!Hash::check($otp, $record->getAttribute('otp_hash'))) {
            return false;
        }

        $record->markAsUsed();

        return $record;
    }
}
