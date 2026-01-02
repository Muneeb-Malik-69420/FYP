<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\RiderDashboardController;

// Social Logins
Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']); 

// Public routes
Route::view('/', 'Customer.public.Home')->name('Home');
Route::view('/browse', 'Customer.public.Browse')->name('Browse');
Route::view('/contact', 'Customer.public.contact')->name('Contact');
Route::view('/blog', 'Customer.public.blog')->name('Blog');



Route::middleware('auth')->group( function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');
});

// Customer routes
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerDashboardController::class,'index'])->name('customer.dashboard');
});

// Supplier routes
Route::middleware(['auth', 'role:supplier'])->group(function () {
    Route::get('/supplier/dashboard', [SupplierDashboardController::class,'index'])->name('supplier.dashboard');
});

// Rider routes
Route::middleware(['auth', 'role:rider'])->group(function () {
    Route::get('/rider/dashboard', [RiderDashboardController::class,'index'])->name('rider.dashboard');
});


