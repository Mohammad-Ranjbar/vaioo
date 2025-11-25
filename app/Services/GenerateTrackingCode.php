<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class GenerateTrackingCode
{
    /**
     * @throws Exception
     */
    public static function generate(string $table): string
    {
        if (Schema::hasTable($table)) {
            do {
                $trackingCode = Str::upper(Str::random(10));
            } while (DB::table($table)->where("tracking_code", $trackingCode)->exists());
            return $trackingCode;
        }
        return throw new Exception("Table does not exists");
    }
}