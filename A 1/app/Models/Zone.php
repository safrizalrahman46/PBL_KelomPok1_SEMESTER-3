<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = [
        'zone_name',
        'rate',
        'province',
        'regency_city',
        'district',
        'village',
        'domicile_address',

    ];

    public $timestamps = false;
}
