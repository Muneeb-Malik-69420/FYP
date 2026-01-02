<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        return view('Customer.private.dashboard'); // Make sure this Blade view exists
    }
}
