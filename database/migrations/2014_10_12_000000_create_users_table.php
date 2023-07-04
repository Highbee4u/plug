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
            $table->uuid('id')->primary();;
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->boolean('has_car')->default(0);
            $table->integer('profile_status')->default(0);
            $table->boolean('otp_verified')->default(0);
            $table->boolean('recovery_mode')->default(0);
            $table->boolean('is_disabled')->default(0);
            $table->integer('login_attempt')->default(0)->nullable();
            $table->string('gender')->nullable();
            $table->integer('passcode')->nullable();
            $table->string('referal_by')->nullable();
            $table->string('referal_code')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
