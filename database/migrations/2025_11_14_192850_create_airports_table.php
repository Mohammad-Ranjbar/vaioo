<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name_fa')->unique();
            $table->string('name_en')->unique();
            $table->string('code',3)->unique();
            $table->boolean('is_active');
            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
