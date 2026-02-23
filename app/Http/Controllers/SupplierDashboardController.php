<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class SupplierDashboardController extends Controller
{
    // public function index()
    // {
    //     return view('Supplier.dashboard'); // Make sure this Blade view exists
    // }
    public function index()
{
    $user = Auth::user();
    $profile = $user->supplierProfile;

    // Logic: 
    // 1. No Profile -> status = 'no_profile'
    // 2. Profile exists -> status = 'pending' or 'approved'
    return view('supplier.dashboard', [
        'profile' => $profile,
        'status' => $profile ? $profile->status : 'no_profile'
    ]);
}
}

