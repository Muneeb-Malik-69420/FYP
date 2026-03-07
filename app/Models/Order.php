<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'phone', 'guest_name', 'guest_email',
        'notes', 'delivery_address', 'total_amount',
        'payment_method', 'status', 'stripe_session_id',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    public function isReviewed(): bool
    {
        return $this->review()->exists();
    }

    /**
     * Get the supplier for this order via order_items → food_items → supplier
     */
    public function getSupplierIdAttribute(): ?int
    {
        return $this->items()
            ->join('food_items', 'order_items.product_id', '=', 'food_items.id')
            ->value('food_items.supplier_id');
    }
}