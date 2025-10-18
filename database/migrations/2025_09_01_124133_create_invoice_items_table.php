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
        Schema::create('invoice_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('invoice_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->integer('quantity');
        $table->decimal('unit_price', 10, 2);#price of 1 unit of an item
        $table->decimal('line_total', 10, 2);#total price for this line item (quantity * unit_price)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
/* (Mariam) Explanation of the code:
   This migration creates the 'invoice_items' table with the specified columns.
   - The 'id' column is the primary key.
   - The 'invoice_id' column is a foreign key referencing the 'invoices' table, with cascading deletes to maintain referential integrity.
   - The 'product_id' column is a foreign key referencing the 'products' table, also with cascading deletes.
   - The 'quantity' column stores the number of units for each invoice item.
   - The 'unit_price' column is a decimal field to store the price per unit of the product, allowing for two decimal places.
   - The 'line_total' column calculates the total price for that line item (quantity multiplied by unit price), also as a decimal with two decimal places.
   - Timestamps are included for tracking creation and update times.
*/