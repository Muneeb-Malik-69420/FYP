<?php

namespace App\Http\Controllers;


class MarketplaceController extends Controller
{
    // app/Http/Controllers/MarketplaceController.php
    public function index()
    {
        // 1. Get Approved Suppliers who have active items
        $suppliers = \App\Models\SupplierProfile::where('status', 'approved')
            ->whereHas('foodItems', function ($query) {
                $query->where('expiry_date', '>', now());
            })->get();

        // 2. Get the latest food items from those suppliers
        $items = \App\Models\FoodItem::where('expiry_date', '>', now())
            ->latest()
            ->get();

        return view('customer.marketplace', compact('suppliers', 'items'));
    }
}
