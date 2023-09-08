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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('transaction_type_id');
            $table->uuid('account_id')->nullable(false);
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->unsignedDecimal('value')->default(0);
            $table->unsignedDecimal('fees')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
