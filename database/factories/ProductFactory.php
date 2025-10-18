<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productTypes = [
            'Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Tablet', 'Phone', 'Headphones',
            'Speaker', 'Camera', 'Printer', 'Router', 'Cable', 'Charger', 'Case'
        ];

        $brands = ['Apple', 'Samsung', 'Dell', 'HP', 'Logitech', 'Sony', 'Canon'];

        return [
            'name' => $this->faker->randomElement($brands) . ' ' . $this->faker->randomElement($productTypes),
            'sku' => $this->faker->unique()->bothify('???-#####'), // example: ABC-12345
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 2000), // Price between 5 and 1000 and 2 decimal places
            'stock_qty' => $this->faker->numberBetween(0, 100), // Stock between 0 and 100
        ];
    }
}
