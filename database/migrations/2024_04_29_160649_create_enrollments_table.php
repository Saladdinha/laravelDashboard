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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->engine = 'postgre';
            $table->id();
            $table->integer('enrollment_id');
            $table->integer('client_id');
            $table->string('group');
            $table->string('modality');
            $table->string('division');
            $table->float('gross_value');
            $table->float('discount_value');
            $table->float('net_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
