<?php

namespace Database\Seeders;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'customer_id' => 1,
            'invoice_date' => '2023-01-01',
            'due_date' => '2023-01-8',
            'total_amount' => 100.00,
        ]);

        Invoice::factory()->count(10)->create(); // creates 10 fake invoices
    }
}
