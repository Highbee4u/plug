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
        Schema::create('liscences', function (Blueprint $table) {
            $table->uuid('id')->primary();;
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('identification_no');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('registration_date');
            $table->string('liscence_class');
            $table->string('expiration_date');
            $table->string('meta')->comment('To store third-party API verification response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liscences');
    }
};
