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
        Schema::create('place_rides', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('driver_id');
            $table->foreign('driver_id')->references('id')->on('users');
            $table->decimal('amount', 19,3);
            $table->string('departure');
            $table->string('destination');
            $table->time('takeoff_time');
            $table->integer('available_seat');
            $table->integer('remaining_seat');
            $table->boolean('ride_started')->default(0);
            $table->boolean('ride_ended')->default(0);
            $table->boolean('is_available')->default(1);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_rides');
    }
};
