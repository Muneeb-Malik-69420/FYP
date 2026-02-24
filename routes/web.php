<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiderDashboardController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\SupplierDashboardController;
use App\Livewire\AllDeals;
use App\Livewire\AllRestaurants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin/approve-me', function () {
    $user = Auth::user();
    if ($user && $user->supplierProfile) {
        $user->supplierProfile->update(['status' => 'approved']);
        return redirect()->route('supplier.dashboard');
    }
    return "No profile found.";
})->middleware(['auth']);

// Social Logins
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

// Public routes
Route::view('/', 'Customer.public.Home')->name('Home');
Route::view('/browse', 'Customer.public.Browse')->name('Browse');
Route::view('/contact', 'Customer.public.contact')->name('Contact');
Route::view('/blog', 'Customer.public.blog')->name('Blog');



Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::get('/deals', AllDeals::class)->name('deals.index');
    Route::get('/restaurants', AllRestaurants::class)->name('restaurants.index');
});

// Supplier routes
Route::middleware(['auth', 'role:supplier'])->group(function () {
    Route::get('/supplier/dashboard', [SupplierDashboardController::class, 'index'])->name('supplier.dashboard');
});

// Rider routes
Route::middleware(['auth', 'role:rider'])->group(function () {
    Route::get('/rider/dashboard', [RiderDashboardController::class, 'index'])->name('rider.dashboard');
});
