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
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);//10 digits in total, 2 after the decimal point
            $table->integer('stock_qty')->default(0);
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
/* (Mariam) Explanation of the code:
   This migration creates the 'products' table with the specified columns.
   - The 'id' column is the primary key.
   - The 'name' column stores the product name.
   - The 'description' column stores a detailed description of the product.
   - The 'price' column is a decimal field to store the product price with two decimal places.
   - The 'stock_qty' column tracks the available stock quantity, defaulting to 0.
   - Timestamps are included for tracking creation and update times.
*/