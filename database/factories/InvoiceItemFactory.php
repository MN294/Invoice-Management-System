<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => \App\Models\Invoice::factory(),
            'product_id' => \App\Models\Product::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'unit_price' => $this->faker->randomFloat(2, 5, 1000),
            # line_total will be calculated automatically in the model
        ];
    }
}
/* (Mariam) Explanation of the code:
   This factory generates fake data for the InvoiceItem model, including:
   - invoice_id: A reference to an existing invoice.
   - product_id: A reference to an existing product.
   - quantity: A random quantity between 1 and 10.
   - unit_price: A random unit price between 5 and 1000, with 2 decimal places.
   - line_total: A random line total calculated as quantity * unit_price.
*/