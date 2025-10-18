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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->date('invoice_date')->default(now());
            $table->date('due_date')->default(now()->addDays(7));
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
/**(Mariam) Explanation of the code:
 * The first line $table->foreignId('customer_id')->constrained()->onDelete('cascade') creates a foreign key relationship between invoices and customers. The foreignId('customer_id') creates an unsigned big integer column that references another table's primary key. The constrained() method automatically establishes the foreign key constraint by looking for a customers table (Laravel pluralizes "customer"). The onDelete('cascade') is crucial - it ensures that when a customer is deleted, all their associated invoices are automatically deleted too, maintaining referential integrity.

*The second line $table->date('invoice_date')->default(now()) creates a date column to track when each invoice was created. The default(now()) automatically sets the invoice date to the current date when a new invoice record is inserted, eliminating the need to manually specify the date every time.

*The third line $table->decimal('total_amount', 10, 2)->default(0) defines a precise monetary field using the decimal type, which is essential for financial calculations. The parameters (10, 2) specify that the column can store up to 10 total digits with exactly 2 decimal places - allowing values from -99,999,999.99 to 99,999,999.99. The default(0) ensures new invoices start with a zero total.
     */
