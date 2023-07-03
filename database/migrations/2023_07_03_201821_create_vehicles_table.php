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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('brand');
            $table->string('colour');
            $table->string('registration_no');
            $table->string('car_model');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('air_condition')->default(0);
            $table->string('manufacture_year');
            $table->string('body_type');
            $table->string('engine_no');
            $table->string('owners_name');
            $table->string('registration_status');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
