<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\cars;

class CarAvailability extends Model
{
    use HasFactory;
    protected $table = 'car_availability';

    protected $fillable = [
        'car_id',
        'start_datetime',
        'end_datetime',
        'status',
        'buffer_time',
    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function car()
    {
        return $this->belongsTo(cars::class, 'car_id');
    }
}
