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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('receiver_name');
            $table->string('receiver_email');
            $table->string('receiver_mobile');
            $table->string('receiver_address');
            $table->string('status')->default('pending');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->string('trx_id')->nullable();
            $table->double('total_amount');
            $table->double('total_discount')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
