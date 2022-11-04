<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;

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

Route::get('/', function () {
    return view('frontend.welcome');
});

// Route::get('/', function () {
//     return view('business.home');
// });

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/courses', function () {
    return view('frontend.courses');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('users', UserController::class)->middleware(['auth', 'verified']);

Route::resource('courses', CourseController::class)->middleware(['auth', 'verified']);

Route::get('/change-password', [UserController::class, 'changePassword'])->middleware(['auth', 'verified'])->name('change-password');
Route::post('/change-password', [UserController::class, 'updatePassword'])->middleware(['auth', 'verified'])->name('update-password');

Route::get('/forbidden', function () {
    return view('message.pages-error-403');
});