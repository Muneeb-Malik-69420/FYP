<?php
namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Supplier;
use App\Models\SupplierProfile;

class CustomerDashboardController extends Controller
{
    public function index() {
    // Door 1: Surplus Items (Available and not expired)
    $surplusItems = FoodItem::with('supplier')
        ->where('status', 'available')
        ->where('expiry_date', '>', now())
        ->latest()
        ->take(4)
        ->get();

    // Door 2: Verified Suppliers
    $suppliers = Supplier::where('is_verified', true)->get();

    return view('customer.private.dashboard', compact('surplusItems', 'suppliers'));
}}