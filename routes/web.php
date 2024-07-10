<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\BookingController;
use Illuminate\Auth\Middleware\Authenticate;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Public routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('calendar', [BookingController::class, 'calendar'])->name('calendar');
Route::get('bookings/create', [BookingController::class, 'createPublic'])->name('bookings.createPublic');
Route::post('bookings', [BookingController::class, 'storePublic'])->name('bookings.storePublic');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('employees', AdminEmployeeController::class);
})->middleware([AdminMiddleware::class, Authenticate::class]);

Route::middleware(Authenticate::class)->group(function () {
    Route::resource('bookings', BookingController::class);    
    Route::get('bookings/data', [BookingController::class, 'data'])->name('bookings.data');
});