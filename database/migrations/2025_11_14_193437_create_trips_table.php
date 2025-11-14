<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representative_id')->constrained('')->restrictOnDelete();
            $table->foreignId('destination_airport_id')->constrained('airports')->restrictOnDelete();
            $table->foreignId('source_airport_id')->constrained('airports')->restrictOnDelete();
            $table->dateTime('departure_date');
            $table->dateTime('arrival_date');
            $table->decimal('capacity_weight');
            $table->decimal('capacity_value');
            $table->enum('status',['planning', 'in_progress', 'completed'])->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
