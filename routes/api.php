<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [\App\Http\Controllers\Api\LoginController::class, 'login'])->name('login');

Route::prefix('clinic')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\ClinicController::class, 'index'])->name('clinic');
    Route::post('/store', [\App\Http\Controllers\Api\ClinicController::class, 'store'])->name('store-clinic')->middleware('auth:sanctum', 'role:admin');
    Route::post('/delete/{id}', [\App\Http\Controllers\Api\ClinicController::class, 'delete'])->name('delete-clinic')->middleware('auth:sanctum', 'role:admin');
});

Route::prefix('schedule')->group(function () {
    Route::post('/store', [\App\Http\Controllers\Api\ScheduleController::class, 'store'])->name('store-schedule')->middleware('auth:sanctum', 'role:admin');
});

Route::prefix('booking')->group(function () {
    Route::post('/store', [\App\Http\Controllers\Api\BookingController::class, 'store'])->name('store-booking')->middleware('auth:sanctum', 'role:user');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
