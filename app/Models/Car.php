<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'type',
        'fuel',
        'transmission',
        'seat',
        'description',
        'image',
        'year',
        'license_plate',
        'price',
        'status',
    ];

    protected $casts = [
        'price' => 'float',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
