<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('representatives', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('national_code')->index()->unique();
            $table->string('passport_number')->nullable()->unique();
            $table->string('email')->nullable()->index()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->index()->unique();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->index()->default('pending');
            $table->text('verification_rejection_reason')->nullable();
            $table->timestamp('verified_at')->nullable();

            $table->decimal('rating_average', 3)->default(0.00);
            $table->unsignedInteger('rating_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('representatives');
    }
};
