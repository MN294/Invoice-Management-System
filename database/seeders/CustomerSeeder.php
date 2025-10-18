<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([//Creating custom data
            'name' => 'Mariam Hassan',
            'email' => 'mariam@example.com',
            'phone' => '123-456-7890',
            'address' => '123 Main St, Anytown, USA',
        ]);
        Customer::create([
            'name' => 'Farid Dehne',
            'email' => 'farid@example.com',
            'phone' => '987-654-3210',
            'address' => '456 Elm St, Othertown, USA',
        ]);
        Customer::create([
            'name' => 'Nourien Mohammed',
            'email' => 'nourien@example.com',
            'phone' => '555-123-4567',
            'address' => '789 Oak St, Sometown, USA',
        ]);
        Customer::create([
            'name' => 'Amjad Alrays',
            'email' => 'amjad@example.com',
            'phone' => '123-456-9890',
            'address' => '123 Main St, SomeOtherTown, USA',
        ]);
        Customer::factory()->count(10)->create();//creates 10 fake customers
    }
}
