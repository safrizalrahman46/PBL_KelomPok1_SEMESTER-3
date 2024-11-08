<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cars;

class RentalRates extends Model
{
    use HasFactory;

    protected $table = 'rental_rates';

    protected $fillable = [
        'car_id',
        'date',
        'daily_rate',
        'season',

    ];

    public $timestamps = false;
    public function car()
    {
        return $this->belongsTo(cars::class, 'car_id');
    }
}
