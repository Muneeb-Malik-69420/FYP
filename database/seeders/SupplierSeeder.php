<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'business_name' => 'GGC Restaurant',
                'business_type' => 'Restaurant',
                'business_location' => 'Grand Trunk Rd, Jhelum Cantt',
            ],
            [
                'business_name' => 'The Bread Basket',
                'business_type' => 'Bakery',
                'business_location' => 'Civil Lines, Jhelum',
            ],
            [
                'business_name' => 'Cafe de Jhelum',
                'business_type' => 'Restaurant',
                'business_location' => 'Main Market, Jhelum',
            ],
            [
                'business_name' => 'EcoGrocers',
                'business_type' => 'Grocery',
                'business_location' => 'Kacheri Road, Jhelum',
            ],
            [
                'business_name' => 'Mama Bites',
                'business_type' => 'HomeChef',
                'business_location' => 'Satellite Town, Jhelum',
            ],
            [
                'business_name' => 'Bake n Flake',
                'business_type' => 'Bakery',
                'business_location' => 'Shandar Chowk, Jhelum',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create([
                'business_name' => $supplier['business_name'],
                'business_type' => $supplier['business_type'],
                'business_location' => $supplier['business_location'],
                'city_id' => 9,
                'status' => 'approved',
                // Assuming you have a user_id foreign key, 
                // replace '1' with a logic to find/assign a user
                'user_id' => 1, 
            ]);
        }
    }
}