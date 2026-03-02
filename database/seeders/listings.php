<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class listings extends Seeder
{
    /**
     * Run the database seeds.
     */
   
        public function run(): void
    {
        $faker = Faker::create();

        // Loop through the supplier IDs from 7 to 25
        foreach (range(7, 25) as $supplierId) {
            
            // Create 3 food items for each supplier
            foreach (range(1, 3) as $index) {
                $originalPrice = $faker->randomFloat(2, 10, 100);
                
                DB::table('food_items')->insert([
                    'supplier_id'      => $supplierId,
                    'item_name'        => $faker->words(2, true),
                    'description'      => $faker->sentence(),
                    'original_price'   => $originalPrice,
                    'discounted_price' => $originalPrice * 0.8, // 20% discount
                    'quantity'         => $faker->numberBetween(1, 50),
                    'image_path'       => 'images/food/default.jpg',
                    'expiry_date'      => Carbon::now()->addDays(rand(1, 10)),
                    'status'           => 'available',
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }
    }
    }

