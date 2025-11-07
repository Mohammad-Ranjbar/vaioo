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
        Schema::create('otp_verifications', function (Blueprint $table) {
            $table->id();
            $table->morphs('authenticatable'); // supports User or any model
            $table->string('channel'); // 'sms' or 'email'
            $table->string('identifier'); // phone or email
            $table->string('otp_hash');
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);
            $table->index(['identifier', 'channel']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_verifications');
    }
};
