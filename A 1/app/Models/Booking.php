<?php

namespace App\Models;

use App\Models\Cars;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'car_id',
        'pickup_location',
        'dropoff_location',
        'start_datetime',
        'end_datetime',
        'status',
        'code_booking',
        'booking_group_id',
        'booking_duration',
        'total_price',
        'total_deposit',
        'total_payment',
        'total_additional_price',

    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}