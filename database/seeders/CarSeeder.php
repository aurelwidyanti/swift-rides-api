<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'name' => 'Toyota Supra',
                'brand' => 'Toyota',
                'price' => 500000,
                'year' => 2021,
                'license_plate' => 'B 1234 ABC',
                'status' => 'available',
            ],
            [
                'name' => 'Honda Civic',
                'brand' => 'Honda',
                'price' => 300000,
                'year' => 2020,
                'license_plate' => 'B 4321 CBA',
                'status' => 'available',
            ],
            [
                'name' => 'Mitsubishi Pajero',
                'brand' => 'Mitsubishi',
                'price' => 700000,
                'year' => 2022,
                'license_plate' => 'B 5678 CDE',
                'status' => 'available',
            ],
        ];

        foreach ($cars as $car) {
            \App\Models\Car::create($car);
        }
    }
}
