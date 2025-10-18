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
        Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->string('address')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
/* (Mariam) Explanation of the code:
   This migration creates the 'customers' table with the specified columns.
   - The 'id' column is the primary key.
   - The 'name', 'email', 'phone', and 'address' columns store customer information.
   - The 'email' column is unique to prevent duplicate entries.
   - Timestamps are included for tracking creation and update times.
*/
