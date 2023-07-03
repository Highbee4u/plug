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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->boolean('has_car')->default(0);
            $table->string('profile_status');
            $table->boolean('otp_verified')->default(0);
            $table->boolean('recovery_mode')->default(0);
            $table->boolean('is_disabled')->default(0);
            $table->string('gender');
            $table->integer('passcode');
            $table->string('referal_by')->nullable();
            $table->string('referal_code')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
