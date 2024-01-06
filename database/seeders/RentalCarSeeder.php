<?php

namespace Database\Seeders;

use App\Models\RentalCar;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        RentalCar::factory()->count(10)->create([
            'user_id' => $users->random()->id
        ]);
    }
}
