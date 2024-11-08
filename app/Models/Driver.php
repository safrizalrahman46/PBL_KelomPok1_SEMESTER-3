<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $table = 'driver';

    protected $fillable = [
        'name',
        'photo',
        'driving_license',
        'expired_driving_license',
        'gender',
        'address',

    ];
}
