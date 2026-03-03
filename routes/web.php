<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiderDashboardController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\SupplierDashboardController;

use App\Livewire\CustomerDashboard;
use App\Livewire\RestaurantProfile;
use App\Livewire\Checkout;
use App\Livewire\GuestCheckout;
use App\Livewire\OrderSuccess;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin/approve-me', function () {
    $user = Auth::user();

    // 1. Check the 'supplier' relationship instead of 'supplierProfile'
    if ($user && $user->supplier) {

        // 2. Update the status directly on the supplier record
        $user->supplier->update([
            'status' => 'approved'
        ]);

        return redirect()->route('supplier.dashboard')->with('message', 'You are now approved!');
    }

    return "No supplier record found for this user. Please complete the 'Setup Your Shop' form first.";
})->middleware(['auth']);

// Social Logins
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

// Public routes
// Route::view('/', 'Customer.public.Home')->name('Home');
// Route::view('/browse', 'Customer.public.Browse')->name('Browse');
// Route::view('/contact', 'Customer.public.contact')->name('Contact');
// Route::view('/blog', 'Customer.public.blog')->name('Blog');

Route::get('/', CustomerDashboard::class)->name('Home');


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::get('/restaurant/{id}', RestaurantProfile::class)
    ->name('restaurants.show');
    Route::get('/checkout', Checkout::class)->name('checkout');
    Route::get('/order-success', OrderSuccess::class)->name('order.success');
    Route::get('/payment-success/{id}', OrderSuccess::class)->name('payment.success');
    Route::get('/payment-cancel', OrderSuccess::class)->name('payment.cancel');
    
// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {

    // This creates the 'restaurants.show' route name that the Blade file is looking for

    
});

// Supplier routes
Route::middleware(['auth', 'role:supplier'])->group(function () {
    Route::get('/supplier/dashboard', [SupplierDashboardController::class, 'index'])->name('supplier.dashboard');
});

// Rider routes
Route::middleware(['auth', 'role:rider'])->group(function () {
    Route::get('/rider/dashboard', [RiderDashboardController::class, 'index'])->name('rider.dashboard');
});
