<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('Admin.dashboard'); // Make sure this Blade view exists
    }
}
