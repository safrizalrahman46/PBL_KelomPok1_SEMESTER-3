<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaVillage extends Model
{
    protected $table = 'indonesia_villages';

    protected $fillable = ['code', 'district_code', 'name', 'meta'];

    // Relationship to district
    public function district()
    {
        return $this->belongsTo(IndonesiaDistrict::class, 'district_code', 'code');
    }
}
