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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('name')->nullable(true);
            $table->string('document');
            $table->integer('stage_id');
            $table->string('stage')->nullable(true);
            $table->float('value');
            $table->float('discount_value');
            $table->float('net_value');
            $table->float('gross_value');
            $table->float('credit_value');
            $table->float('extra_value');
            $table->integer('enrollment_status');
            $table->string('payments_type')->nullable(true);
            $table->integer('payment_status');
            $table->date('inserted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
