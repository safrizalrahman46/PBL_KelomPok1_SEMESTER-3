<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaCity extends Model
{
    protected $table = 'indonesia_cities';

    protected $fillable = ['code', 'province_code', 'name', 'meta'];

    // Relationship to province
    public function province()
    {
        return $this->belongsTo(IndonesiaProvince::class, 'province_code', 'code');
    }

    // Relationship to districts
    public function districts()
    {
        return $this->hasMany(IndonesiaDistrict::class, 'city_code', 'code');
    }
}
