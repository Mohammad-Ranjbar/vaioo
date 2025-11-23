<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->constrained()->restrictOnDelete();
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('reciver_name');
            $table->string('reciver_phone');
            $table->text('description')->nullable();
            $table->decimal('weight');
            $table->decimal('declared_value',12);
            $table->enum('status', ['pending', 'accepted', 'picked_up', 'in_transit', 'delivered'])->default('pending');
            $table->string('tracking_code')->index();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
