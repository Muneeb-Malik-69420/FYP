<?php

namespace App\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
protected $casts = [
        'expiry_date' => 'datetime',
    ];    
protected $fillable = [
        'supplier_id',
        'item_name',
        'description',
        'original_price',
        'discounted_price',
        'quantity',
        'image_path',
        'expiry_date',
        'status'
    ];
    public function foodItems()
    {
        return $this->hasMany(FoodItem::class, 'supplier_id');
    }
    public function supplier() {
    return $this->belongsTo(Supplier::class);
}
}
