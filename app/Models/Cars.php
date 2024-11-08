<?php

namespace App\Models;

use App\Models\CarAvailability;
use App\Models\RentalRates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;
    protected $table = 'cars';

    protected $fillable = [
        'car_brand_id',
        'car_name',
        'image',
        'type',
        'capacity',
        'price_per_day',
        'price_per_km',
        'price_per_area',
        'availability_start_time',
        'availability_end_time',
        'is_available',
        'car_availability_id',
    ];

    public $timestamps = false;

    public function CarAvailability()
    {
        return $this->belongsTo(CarAvailability::class, 'id', 'car_availability_id');
    }

    public function RentalRates()
    {
        return $this->hasMany(RentalRates::class, 'car_id');
    }

    // public function Booking()
    // {
    //     return $this->hasMany(Booking::class, 'car_id');
    // }
}