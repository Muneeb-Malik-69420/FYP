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
        'status',
        'cover_photo'

    ];
    public function getThumbnail()
    {
        // 1. If supplier uploaded a photo, show it
        if ($this->cover_photo) {
            return asset('storage/' . $this->cover_photo);
        }

        // 2. Fallback based on your existing business_type column
        $placeholders = [
            'Bakery'     => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=800',
            'Restaurant' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800',
            'Cafe'       => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=800',
            'Grocery'    => 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=800',
            'Fast Food'  => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=800',
        ];

        // Returns the matching image or a general food image if the type doesn't match the list
        return $placeholders[$this->business_type] ?? 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=800';
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
