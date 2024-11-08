<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
class Deposit extends Model
{
    use HasFactory;
    protected $table = 'deposit';

    protected $fillable = [
        'booking_id',
        'deposit_amount',
        'status',
        'payment_method',
        'paid_at',
        'refunded_at',

    ];

    public $timestamps = false;
    public function booking()
    {
        return $this->belongsTo(booking::class, 'booking_id');
    }
}
