<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InsuranceProduct;

class InsuranceProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InsuranceProduct::upsert([
            [
                'name' => 'Home',
                'system_name' => 'home',
                'description' => 'Your current or soon-to-be home',
            ],
            [
                'name' => 'Auto',
                'system_name' => 'auto',
                'description' => 'Your personal vehicle(s)',
            ],
            [
                'name' => 'Recreational vehicle(s)',
                'system_name' => 'recreational_vehicle',
                'description' => 'Your boat RV, motorcycle, etc'
            ]
        ], 'id');
    }
}
