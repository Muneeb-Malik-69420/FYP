<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierProfile extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'business_type',
        'contact_phone',
        'address',
        'business_location', // Add this!
        'license_proof',
        'status'
    ];
    protected $table = 'suppliers';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function foodItems()
    {
        return $this->hasMany(FoodItem::class, 'supplier_id');
    }
    public function city()
{
    return $this->belongsTo(City::class);
}
}
