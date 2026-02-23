<?php
namespace App\Http\Controllers;

use App\Models\SupplierProfile;
use App\Models\FoodItem;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        // 1. Get all suppliers that have been approved
        $suppliers = SupplierProfile::where('status', 'approved')->get();

        // 2. Get the latest food items that haven't expired yet
        $items = FoodItem::where('expiry_date', '>', now())
            ->latest() 
            ->get();

        // 3. Pass both variables to your view
        return view('Customer.private.dashboard', compact('suppliers', 'items'));
    }
}