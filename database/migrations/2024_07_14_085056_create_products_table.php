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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price',10,2);
            $table->integer('discount')->nullable();
            $table->string('image')->nullable();
            // $table->string('category_id')->nullable();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->integer('stock');
            //image/any file will store in filesystem- then that path
            //will store in database

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
