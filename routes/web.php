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
    return view('frontend.welcome');
});

Route::get('about', function () {
    return view('frontend.about');
});

Route::get('courses', function () {
    return view('frontend.courses');
});

Route::get('login', function () {
    return view('auth.login');
});

Route::get('register', function () {
    return view('auth.register');
});

Route::get('password/confirm', function () {
    return view('auth.passwords.confirm');
});

Route::get('password/email', function () {
    return view('auth.passwords.email');
});

Route::get('password/reset', function () {
    return view('auth.passwords.reset');
});

Route::get('verify', function () {
    return view('auth.verify');
});
Route::get('coffee', function () {
    return view('business.home');
});

Route::post('register_user', function () {
    return "registered";
});

Route::post('login_user', function () {
    return "logged in User";
});

Route::post('password_confirm', function () {
    return "Password Confirmed";
});

Route::post('password_email', function () {
    return "Email Sent";
});

Route::post('password_update', function () {
    return "Password Reset";
});

Route::post('email_verify', function () {
    return "Verification Resend";
});
//Backend
Route::get('dashboard', function () {
    return view('backend.dashboard');
});
