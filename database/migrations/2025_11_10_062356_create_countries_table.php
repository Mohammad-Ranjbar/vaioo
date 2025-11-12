<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('iso');
            $table->string('tld');
            $table->string('name_en');
            $table->string('name_fa');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
