<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        public function definition(): array
    {
        $invoiceDate = $this->faker->dateTimeBetween('-1 year', 'now'); // random past date
        $dueDate = (clone $invoiceDate)->modify('+7 days'); // add 7 days to invoice_date

        return [
            'customer_id' => \App\Models\Customer::factory(),
            'invoice_date' => $invoiceDate,
            'due_date' => $dueDate,
            'total_amount' => 0, // will be recalculated later
        ];
    }
    // public function definition(): array
    // {
    //     return [
    //          'customer_id' => \App\Models\Customer::factory(),
    //         'invoice_date' => $this->faker->date(),
    //         //create a due date 7 days after the invoice date
    //         'due_date' => $this->faker->dateTimeBetween('now', '+7 days'),
    //         // total amount is sum of all invoice items
    //         'total_amount' => 0,
    //     ];
    // }
}
/* What I did(Mariam):
   - Added a factory for the Invoice model to streamline the creation of invoice records during testing.
   - The factory generates fake data for the customer_id, invoice_date, and total_amount fields.
   - This allows for easy and consistent creation of invoices with realistic data.
*/
