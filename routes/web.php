<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/','Customer.public.Home')->name('Home');
Route::view('/Browse','Customer.public.Browse')->name('Browse');
Route::view('/contact','Customer.public.contact')->name('Contact');
Route::view('/blog','Customer.public.blog')->name('Blog');
Route::view('/home','dashboard');

