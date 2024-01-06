<?php

namespace Database\Seeders;

use App\Models\RentalCar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RentalCar::factory()->count(10)->create();
    }
}
