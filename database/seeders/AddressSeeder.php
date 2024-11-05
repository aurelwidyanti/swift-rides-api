<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            [
                'user_id' => 2,
                'title' => 'Home',
                'city' => 'Semarang',
                'street' => 'Jl. Raya Tebak Dimana No. 1',
            ],
            [
                'user_id' => 2,
                'title' => 'Work',
                'city' => 'Jakarta',
                'street' => 'Jl. Raya Coba Tebak Dimana No. 2',
            ],
        ];

        foreach ($addresses as $address) {
            \App\Models\Address::create($address);
        }
    }
}
