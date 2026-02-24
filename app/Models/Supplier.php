<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'user_id',           // Add this to fix the error
        'city_id',           // Necessary for our new location logic
        'business_name',
        'business_type',
        'business_location',
        'license_document',
        'is_verified',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
