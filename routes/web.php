<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('coffee', function () {
    return view('business.home');
});

// Route::get('login', function () {
//     return view('auth.login');
// });

// Route::post('login_user', function () {
//     return "logged in User";
// });

// Route::get('register', function () {
//     return view('auth.register');
// });

// Route::post('register_user', function () {
//     return "registered";
// });

// Route::get('verify', function () {
//     return view('auth.verify');
// });

// Route::post('email_verify', function () {
//     return "Verification Resend";
// });

// Route::get('dashboard', function () {
//     return view('backend.dashboard');
// });

// Route::get('forgot_password', function () {
//     return view('auth.passwords.email');
// });

// Route::post('password_reset_email', function () {
//     return "Password Reset Email Sent";
// });

// Route::get('password_reset', function () {
//     return view('auth.passwords.reset');
// });

// Route::post('password_update', function () {
//     return "Password Reset";
// });

Route::get('password_confirm', function () {
    return view('auth.passwords.confirm');
});

Route::post('password_confirmed', function () {
    return "Password Confirmed";
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login_user', [AuthController::class, 'loginUser'])->name('login.user');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register_user', [AuthController::class, 'registerUser'])->name('register.user');
Route::get('verify', [AuthController::class, 'verify']);
Route::post('verify_resend', [AuthController::class, 'verifyResend']);
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot_password', [AuthController::class, 'forgotPassword']);
Route::post('password_reset_email', [AuthController::class, 'passwordResetEmail']);
Route::get('password_reset', [AuthController::class, 'passwordReset']);
Route::post('password_update', [AuthController::class, 'passwordUpdate']);