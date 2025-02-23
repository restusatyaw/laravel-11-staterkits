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
            $table->string('code', 100);
            $table->uuid('user_id');
            $table->uuid('donation_type');
            $table->text('snap_token')->nullable();
            $table->double('total_payment', 15, 2)->nullable()->default(0);
            $table->enum('payment_method', ['bank_transfer', 'manual'])->default('manual');
            $table->enum('status', ['pending', 'expired','cenceled','completed'])->default('pending');
            $table->dateTime('payment_date');
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
