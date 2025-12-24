<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialAuthController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/','Customer.public.Home')->name('Home');
Route::view('/Browse','Customer.public.Browse')->name('Browse');
Route::view('/contact','Customer.public.contact')->name('Contact');
Route::view('/blog','Customer.public.blog')->name('Blog');
// Route::view('/home','dashboard');
Route::view('/dashboard','home');


Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);


