<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'address_id',
        'total_price',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'price' => 'float',
        'total_price' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            $booking->calculateTotalPrice();
        });

        static::updating(function ($booking) {
            $booking->calculateTotalPrice();
        });
    }

    public function calculateTotalPrice()
    {
        $car = $this->car;
        if ($car && $this->start_date && $this->end_date) {
            $start = Carbon::parse($this->start_date);
            $end = Carbon::parse($this->end_date);
            $days = $end->diffInDays($start);

            if ($days > 0) {
                $this->total_price = $car->price * $days;
            }
        }
    }
}
