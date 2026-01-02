<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Use match to determine the dashboard route
        $route = match (true) {
            $user->hasRole('admin')    => 'admin.dashboard',
            $user->hasRole('supplier') => 'supplier.dashboard',
            $user->hasRole('rider')    => 'rider.dashboard',
            default                     => 'customer.dashboard',
        };

        return redirect()->route($route);
    }
}
