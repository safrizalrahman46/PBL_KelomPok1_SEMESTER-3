<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPickupCharge extends Model
{
    use HasFactory;
    protected $table = 'delivery_pickup_charges';

    protected $fillable = [
        'pickup_location',
        'dropoff_location',
        'charge',

    ];

    public $timestamps = false;
}
