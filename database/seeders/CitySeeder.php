<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City; // Ensure this is imported

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Jhelum',
            'Lahore',
            'Islamabad',
            'Rawalpindi',
            'Gujrat',
            'Sialkot',
            'Faisalabad',
            'Karachi',
            'Peshawar',
            'Multan'
        ];

        foreach ($cities as $cityName) {
            City::firstOrCreate(['name' => $cityName]);
        }
    }
}