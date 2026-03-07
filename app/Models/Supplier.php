<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'user_id',
        'city_id',
        'business_name',
        'business_type',
        'business_location',
        'license_document',
        'is_verified',
        'status',
        'cover_photo',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function foodItems()
    {
        return $this->hasMany(FoodItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    // -------------------------------------------------------------------------
    // Dynamic rating attributes
    // -------------------------------------------------------------------------

    public function getRatingAttribute(): string
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? number_format($avg, 1) : '0.0';
    }

    public function getReviewCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getReviewCountLabelAttribute(): string
    {
        $count = $this->reviewCount;
        if ($count >= 1000) return round($count / 1000, 1) . 'k';
        if ($count >= 500) return '500+';
        if ($count >= 100) return '100+';
        return (string) $count;
    }

    // -------------------------------------------------------------------------
    // Thumbnail helper
    // -------------------------------------------------------------------------

    public function getThumbnail(): string
    {
        if ($this->cover_photo) {
            return asset('storage/' . $this->cover_photo);
        }

        $placeholders = [
            'Bakery'     => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=800',
            'Restaurant' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=800',
            'Cafe'       => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?q=80&w=800',
            'Grocery'    => 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=800',
            'Fast Food'  => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=800',
        ];

        return $placeholders[$this->business_type] ?? 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=800';
    }
}