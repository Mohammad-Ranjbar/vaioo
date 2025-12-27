<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->morphs('sender');
            $table->morphs('receiver');
            $table->string('subject');
            $table->text('message');
            $table->boolean('read')->index()->default(false);
            $table->dateTime('read_at')->nullable();
            $table->timestamps();

            $table->index(['sender_type', 'sender_id', 'created_at']);
            $table->index(['receiver_type', 'receiver_id', 'read', 'created_at']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
