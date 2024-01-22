<?php

namespace Database\Seeders;

use App\Models\RentalCar;
use App\Models\Reservation;
use App\Models\User;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $rentalCars = RentalCar::all();

        Reservation::factory()->count(10)->create([
            'user_id' => $users->random()->id,
            'rental_car_id' => $rentalCars->random()->id,
        ]);
    }
}
