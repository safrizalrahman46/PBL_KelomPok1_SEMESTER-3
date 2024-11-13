<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;
use App\Models\AdditionalService;


class BookingServices extends Model
{
    use HasFactory;
    protected $table = 'booking_services';

    protected $fillable = [
        'booking_id',
        'additional_service_id',
        'price',
    ];

    public $timestamps = false; // Assuming you want to use created_at and updated_at timestamps
    public function booking()
    {
        return $this->belongsTo(booking::class, 'booking_id');
    }

    public function AdditionalService()
    {
        return $this->belongsTo(AdditionalService::class, 'additional_service_id');
    }

}

