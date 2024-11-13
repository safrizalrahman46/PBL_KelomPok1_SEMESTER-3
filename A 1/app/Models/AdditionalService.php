<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    use HasFactory;
    protected $table = 'additional_services';

    protected $fillable = [
        'name',
        'price',
    ];

    public $timestamps = false;
}