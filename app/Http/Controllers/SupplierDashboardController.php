<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class SupplierDashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Ensure the 'supplier' relationship is fresh
        $profile = $user->supplier()->first();

        // Safety check: What is actually in the database?
        // If you just moved 'status' to the suppliers table, 
        // make sure this column exists there.
        $status = $profile ? $profile->status : 'no_profile';

        return view('supplier.dashboard', [
            'profile' => $profile,
            'status'  => $status
        ]);
    }
}
