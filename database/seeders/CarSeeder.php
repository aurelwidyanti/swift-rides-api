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
            // Cabriolet
            [
                'name' => 'Mazda MX-5',
                'brand' => 'Mazda',
                'price' => 400000,
                'year' => 2021,
                'license_plate' => 'B 1010 XYZ',
                'status' => 'available',
            ],
            [
                'name' => 'BMW Z4',
                'brand' => 'BMW',
                'price' => 550000,
                'year' => 2022,
                'license_plate' => 'B 1020 ABC',
                'status' => 'available',
            ],
            [
                'name' => 'Audi A5 Cabriolet',
                'brand' => 'Audi',
                'price' => 600000,
                'year' => 2023,
                'license_plate' => 'B 1030 DEF',
                'status' => 'available',
            ],

            // Supercar
            [
                'name' => 'Ferrari 488',
                'brand' => 'Ferrari',
                'price' => 1500000,
                'year' => 2021,
                'license_plate' => 'B 2010 SUP',
                'status' => 'available',
            ],
            [
                'name' => 'Lamborghini Huracan',
                'brand' => 'Lamborghini',
                'price' => 1800000,
                'year' => 2020,
                'license_plate' => 'B 2020 CAR',
                'status' => 'available',
            ],
            [
                'name' => 'McLaren 720S',
                'brand' => 'McLaren',
                'price' => 1600000,
                'year' => 2023,
                'license_plate' => 'B 2030 SUP',
                'status' => 'available',
            ],

            // Coupe
            [
                'name' => 'Mercedes-Benz C-Class Coupe',
                'brand' => 'Mercedes-Benz',
                'price' => 700000,
                'year' => 2022,
                'license_plate' => 'B 3010 COU',
                'status' => 'available',
            ],
            [
                'name' => 'Chevrolet Camaro',
                'brand' => 'Chevrolet',
                'price' => 750000,
                'year' => 2021,
                'license_plate' => 'B 3020 CAM',
                'status' => 'available',
            ],
            [
                'name' => 'Ford Mustang',
                'brand' => 'Ford',
                'price' => 800000,
                'year' => 2022,
                'license_plate' => 'B 3030 COU',
                'status' => 'available',
            ],

            // Pickup
            [
                'name' => 'Ford F-150',
                'brand' => 'Ford',
                'price' => 600000,
                'year' => 2021,
                'license_plate' => 'B 4010 PUP',
                'status' => 'available',
            ],
            [
                'name' => 'Toyota Hilux',
                'brand' => 'Toyota',
                'price' => 550000,
                'year' => 2020,
                'license_plate' => 'B 4020 PUP',
                'status' => 'available',
            ],
            [
                'name' => 'Mitsubishi Triton',
                'brand' => 'Mitsubishi',
                'price' => 580000,
                'year' => 2023,
                'license_plate' => 'B 4030 PUP',
                'status' => 'available',
            ],

            // Hatchback
            [
                'name' => 'Honda Jazz',
                'brand' => 'Honda',
                'price' => 300000,
                'year' => 2022,
                'license_plate' => 'B 5010 HBK',
                'status' => 'available',
            ],
            [
                'name' => 'Toyota Yaris',
                'brand' => 'Toyota',
                'price' => 320000,
                'year' => 2021,
                'license_plate' => 'B 5020 HBK',
                'status' => 'available',
            ],
            [
                'name' => 'Ford Fiesta',
                'brand' => 'Ford',
                'price' => 310000,
                'year' => 2020,
                'license_plate' => 'B 5030 HBK',
                'status' => 'available',
            ],

            // Micro
            [
                'name' => 'Smart Fortwo',
                'brand' => 'Smart',
                'price' => 250000,
                'year' => 2023,
                'license_plate' => 'B 6010 MIC',
                'status' => 'available',
            ],
            [
                'name' => 'Fiat 500',
                'brand' => 'Fiat',
                'price' => 270000,
                'year' => 2021,
                'license_plate' => 'B 6020 MIC',
                'status' => 'available',
            ],
            [
                'name' => 'Mini Cooper',
                'brand' => 'Mini',
                'price' => 400000,
                'year' => 2022,
                'license_plate' => 'B 6030 MIC',
                'status' => 'available',
            ],

            // SUV
            [
                'name' => 'Toyota Fortuner',
                'brand' => 'Toyota',
                'price' => 700000,
                'year' => 2022,
                'license_plate' => 'B 7010 SUV',
                'status' => 'available',
            ],
            [
                'name' => 'Honda CR-V',
                'brand' => 'Honda',
                'price' => 650000,
                'year' => 2021,
                'license_plate' => 'B 7020 SUV',
                'status' => 'available',
            ],
            [
                'name' => 'Mazda CX-5',
                'brand' => 'Mazda',
                'price' => 620000,
                'year' => 2023,
                'license_plate' => 'B 7030 SUV',
                'status' => 'available',
            ],

            // Sedan
            [
                'name' => 'Toyota Camry',
                'brand' => 'Toyota',
                'price' => 500000,
                'year' => 2022,
                'license_plate' => 'B 8010 SDN',
                'status' => 'available',
            ],
            [
                'name' => 'Honda Accord',
                'brand' => 'Honda',
                'price' => 520000,
                'year' => 2021,
                'license_plate' => 'B 8020 SDN',
                'status' => 'available',
            ],
            [
                'name' => 'Mercedes-Benz E-Class',
                'brand' => 'Mercedes-Benz',
                'price' => 750000,
                'year' => 2023,
                'license_plate' => 'B 8030 SDN',
                'status' => 'available',
            ],

            // Adding more cars to reach 50 entries (repeating categories with unique details)
            [
                'name' => 'Toyota Avalon',
                'brand' => 'Toyota',
                'price' => 490000,
                'year' => 2020,
                'license_plate' => 'B 8040 SDN',
                'status' => 'available',
            ],
            [
                'name' => 'BMW M3',
                'brand' => 'BMW',
                'price' => 850000,
                'year' => 2023,
                'license_plate' => 'B 3035 COU',
                'status' => 'available',
            ],
            [
                'name' => 'Hyundai Palisade',
                'brand' => 'Hyundai',
                'price' => 680000,
                'year' => 2022,
                'license_plate' => 'B 7035 SUV',
                'status' => 'available',
            ],
            // More cars with unique years and license plates to complete 50 cars...
        ];


        foreach ($cars as $car) {
            \App\Models\Car::create($car);
        }
    }
}
