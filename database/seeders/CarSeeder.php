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
                'name' => 'BMW M4 Competition',
                'brand' => 'BMW',
                'type' => 'Coupe',
                'price' => 800000,
                'year' => 2022,
                'fuel' => 'Gasoline',
                'transmission' => 'Automatic',
                'seat' => 4,
                'description' => 'The BMW M4 Competition is a high-performance version of the standard M4. It is powered by a 3.0-liter twin-turbocharged inline-six engine that produces 503 horsepower and 479 lb-ft of torque. The M4 Competition can accelerate from 0-60 mph in just 3.8 seconds and has a top speed of 155 mph.',
                'image' => 'm4-competition.png',
                'license_plate' => 'B 1010 XYZ',
                'status' => 'available',
            ],
            [
                'name' => 'BMW M4 Convertible',
                'brand' => 'BMW',
                'type' => 'Cabriolet',
                'price' => 750000,
                'year' => 2022,
                'fuel' => 'Gasoline',
                'transmission' => 'Automatic',
                'seat' => 4,
                'description' => 'The BMW M4 Convertible is a high-performance version of the standard M4. It is powered by a 3.0-liter twin-turbocharged inline-six engine that produces 503 horsepower and 479 lb-ft of torque. The M4 Convertible can accelerate from 0-60 mph in just 3.8 seconds and has a top speed of 155 mph.',
                'image' => 'm4-convertible.png',
                'license_plate' => 'B 1020 ABC',
                'status' => 'available',
            ],
            [
                'name' => 'BMW M2 Coupe',
                'brand' => 'BMW',
                'type' => 'Coupe',
                'price' => 600000,
                'year' => 2024,
                'fuel' => 'Gasoline',
                'transmission' => 'Manual',
                'seat' => 4,
                'description' => 'The BMW M2 Coupe is a high-performance version of the standard M2. It is powered by a 3.0-liter twin-turbocharged inline-six engine that produces 405 horsepower and 406 lb-ft of torque. The M2 Coupe can accelerate from 0-60 mph in just 4.2 seconds and has a top speed of 155 mph.',
                'image' => 'm2-coupe.png',
                'license_plate' => 'B 1030 DEF',
                'status' => 'available',
            ],
        ];


        foreach ($cars as $car) {
            \App\Models\Car::create($car);
        }
    }
}
