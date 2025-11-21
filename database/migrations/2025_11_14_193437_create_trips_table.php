<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('representative_id')->constrained()->restrictOnDelete();
            $table->foreignId('source_airport_id')->constrained('airports')->restrictOnDelete();
            $table->foreignId('destination_airport_id')->constrained('airports')->restrictOnDelete();

            $table->date('departure_date');
            $table->date('arrival_date');
            $table->decimal('capacity_weight');
            $table->unsignedBigInteger('capacity_value');
            $table->enum('status',['planning', 'in_progress', 'completed'])->index();
            $table->unique(['representative_id','source_airport_id','destination_airport_id'],'unique_trip');
            $table->timestamps();

            $table->index(['status', 'departure_date'], 'idx_status_departure');
            $table->index(['representative_id', 'status', 'departure_date'], 'idx_rep_status_date');
            $table->index(['source_airport_id', 'destination_airport_id', 'departure_date'], 'idx_route_date');
            $table->index(['status', 'source_airport_id', 'destination_airport_id'], 'idx_status_route');
            $table->index('departure_date', 'idx_departure');
            $table->index('arrival_date', 'idx_arrival');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
