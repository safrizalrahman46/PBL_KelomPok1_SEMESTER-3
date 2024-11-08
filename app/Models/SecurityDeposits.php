<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking; 
class SecurityDeposits extends Model
{
    use HasFactory;
    protected $table = 'security_deposits';

    protected $fillable = [
        'booking_id',
        'deposit_amount',
        'status',


    ];

    public $timestamps = false;
    public function booking()
    {
        return $this->belongsTo(booking::class, 'booking_id');
    }
}
