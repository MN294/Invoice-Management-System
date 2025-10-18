<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            // User::factory(10)->create();

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            $this->call([
                CustomerSeeder::class,
                ProductSeeder::class,
                InvoiceSeeder::class,
                InvoiceItemSeeder::class,
            ]);
        Invoice::all()->each(function ($invoice) {
        $invoice->total_amount = $invoice->items()->sum('line_total');
        $invoice->save();
    });
        }
    }
/*What this code does:
   - It seeds the database with initial data for testing and development.
   - It creates a test user and then calls other seeders to populate the database with customers, products, invoices, and invoice items.
   This ensures that the application has the necessary data to function correctly during development.
*/
