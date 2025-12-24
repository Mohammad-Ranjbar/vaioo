<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Ipe\Sdk\Facades\SmsIr;

readonly class SmsService
{
    public static function sendSms(string $mobile, string $template, array $params): void
    {
        try {

            SmsIr::verifySend($mobile, $template, $params);

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

}
