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
        Schema::create('associative_clients_enrollments', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->references('client_id')->on('clients');
            $table->integer('enrollment_id')->references('enrollment_id')->on('enrollments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associative_clients_enrollments');
    }
};
