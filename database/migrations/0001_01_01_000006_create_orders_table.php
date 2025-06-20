<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['Menunggu', 'Dikonfirmasi', 'Packaging', 'Pengantaran', 'Diterima', 'Dibatalkan'])->default('Menunggu');
            $table->text('shipping_address');
            $table->string('shipping_method');
            $table->string('payment_method');
            $table->string('screenshot')->nullable();
            $table->boolean('payment_status')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};