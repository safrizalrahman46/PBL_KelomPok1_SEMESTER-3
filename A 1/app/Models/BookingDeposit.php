<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\Deposit;
use App\Models\SecurityDeposits;
class BookingDeposit extends Model
{
    use HasFactory;
    protected $table = 'booking_deposits';

    protected $fillable = [
        'booking_id',
        'deposit_amount',
        'status',
    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function Deposit() {
        return $this->hasMany(Deposit::class, 'booking_id');
    }

    public function SecurityDeposits() {
        return $this->hasMany(SecurityDeposits::class, 'booking_id');
    }

}
