<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
// use App\Models\User;

class ManageBooking extends Model
{
    use HasFactory;
    protected $table = 'manage_bookings';

    protected $fillable = [
        'booking_id',
        'status',
        'notes',

    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function booking()
    {
        return $this->belongsTo(booking::class, 'booking_id');
    }
    // public function bookingd()
    // {
    //     return $this->belongsTo(booking::class, 'code_booking');
    // }
    // public function status()
    // {
    //     return $this->belongsTo(status::class, 'booking_id');
    // }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
