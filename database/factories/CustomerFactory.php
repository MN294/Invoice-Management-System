<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
/* What I did(Mariam):
- I defined the default state for the Customer model using the Faker library to generate fake data for testing.
- I added the necessary fields to the factory to match the database schema.
- I ensured that the email field is unique to avoid duplication issues during testing and used safeEmail() to generate a valid email format.
- I used phoneNumber() to generate a random phone number and address() to generate a random address.
*/