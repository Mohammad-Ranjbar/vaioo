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
            $table->string('code')->nullable();
            $table->string('iso')->nullable();
            $table->string('tld')->nullable();
            $table->string('name_en')->unique();
            $table->string('name_fa')->unique();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
