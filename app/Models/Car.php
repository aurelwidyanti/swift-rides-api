<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'year',
        'license_plate',
        'price',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
