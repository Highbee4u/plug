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
        Schema::create('referral_usages', function (Blueprint $table) {
            $table->uuid('id')->primary();;
            $table->string('referer_user_id');
            $table->foreign('referer_user_id')->references('id')->on('users');
            $table->string('referee_user_id');
            $table->foreign('referee_user_id')->references('id')->on('users');
            $table->decimal('transaction_volume', 19, 4)->default(0);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_usages');
    }
};
