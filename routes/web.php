<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('default_welcome', function () {
    return view('default_welcome');
});
//frontend
Route::get('/', function () {
    return view('home.welcome');
});

Route::get('/about', function () {
    return view('home.about');
});

//Backend
Route::get('/dashboard', function () {
    return view('backend.dashboard');
});