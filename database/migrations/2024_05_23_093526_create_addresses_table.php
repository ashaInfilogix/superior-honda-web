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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id()->primary();
            $table->integer('user_id');
            $table->string('full_name');
            $table->string('mobile_number');
            $table->string('address');
            $table->integer('state_id');
            $table->string('city');
            $table->integer('postal_code');
            $table->string('nearby');
            $table->integer('country_id');
            $table->boolean('is_default')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
