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

            $table->foreignId('parent_id')->nullable()->constrained('messages')->cascadeOnDelete();

            $table->enum('type', ['regular', 'reply'])->default('regular');

            $table->string('original_subject')->nullable();

            $table->string('subject');
            $table->text('message');
            $table->boolean('read')->index()->default(false);
            $table->dateTime('read_at')->nullable();

            $table->timestamps();

            $table->index(['receiver_type', 'receiver_id', 'read']);

            $table->index(['parent_id']);
            $table->index(['type']);

            $table->index(['parent_id', 'sender_id']);
            $table->index(['parent_id', 'receiver_id']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
