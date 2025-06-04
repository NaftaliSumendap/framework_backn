<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('sold')->default(0);
            $table->json('specifications')->nullable();
            $table->string('brand')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->string('image_path')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};