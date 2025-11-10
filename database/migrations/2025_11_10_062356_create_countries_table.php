<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        $sql = database_path( 'countries.sql');
        DB::unprepared($sql);
    }

    public function down(): void
    {
        DB::table('countries')->truncate();
    }
};
