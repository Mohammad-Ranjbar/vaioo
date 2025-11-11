<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        $sqlFile = database_path('countries.sql');

        if (File::exists($sqlFile)) {
            $sql = File::get($sqlFile);
            DB::unprepared($sql);
        } else {
            throw new \Exception("SQL file not found: {$sqlFile}");
        }
    }

    public function down(): void
    {
        DB::table('countries')->truncate();
    }
};
