<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    protected $table = 'charges';

    protected $fillable = [
        'pickup_location',
        'dropoff_location',
        'charge',

    ];

    public $timestamps = false;
}
