<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaProvince extends Model
{
    protected $table = 'indonesia_provinces';

    protected $fillable = ['code', 'name', 'meta'];

    // Relationship to cities
    public function cities()
    {
        return $this->hasMany(IndonesiaCity::class, 'province_code', 'code');
    }
}
