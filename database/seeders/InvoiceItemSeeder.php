<?php

namespace Database\Seeders;
use App\Models\InvoiceItem;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceItem::create([
            'invoice_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
            'unit_price' => 50.00,
            'line_total' => 100.00,
        ]);
        // InvoiceItem::factory()->count(10)->create(); // creates 10 fake invoice items
        Invoice::all()->each(function ($invoice) {
    // Guarantee at least 1 item
    $products = Product::inRandomOrder()->take(rand(1, 5))->get();

    foreach ($products as $product) {
        $quantity = rand(1, 5);
        $invoice->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unit_price' => $product->price,
            'line_total' => $quantity * $product->price,
        ]);
    }
    
    // Update total
    $invoice->total_amount = $invoice->items()->sum('line_total');
    $invoice->save();
});
    }
}
