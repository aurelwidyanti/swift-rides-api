<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::group(['prefix' => 'cars'], function () {
        Route::get('/', [CarController::class, 'index']);
        Route::post('/', [CarController::class, 'store']);
        Route::get('/{car}', [CarController::class, 'show']);
        Route::put('/{car}', [CarController::class, 'update']);
        Route::put('/updateStatus/{car}', [CarController::class, 'updateStatus']);
        Route::delete('/{car}', [CarController::class, 'destroy']);
    });

    Route::group(['prefix' => 'addresses'], function () {
        Route::get('/', [AddressController::class, 'index']);
        Route::post('/', [AddressController::class, 'store']);
        Route::get('/{address}', [AddressController::class, 'show']);
        Route::put('/{address}', [AddressController::class, 'update']);
        Route::delete('/{address}', [AddressController::class, 'destroy']);
    });
    Route::get('/addressesByUser', [AddressController::class, 'addressesByUser']);

    Route::group(['prefix' => 'bookings'], function () {
        Route::get('/', [BookingController::class, 'index']);
        Route::post('/', [BookingController::class, 'store']);
        Route::get('/{booking}', [BookingController::class, 'show']);
        Route::put('/{booking}', [BookingController::class, 'update']);
        Route::put('/updateStatus/{booking}', [BookingController::class, 'updateStatus']);
        Route::delete('/{booking}', [BookingController::class, 'destroy']);
    });
    Route::get('/bookingsByUser', [BookingController::class, 'bookingsByUser']);
    
    Route::group(['prefix' => 'payments'], function () {
        Route::get('/', [PaymentController::class, 'index']);
        Route::post('/', [PaymentController::class, 'store']);
        Route::get('/{payment}', [PaymentController::class, 'show']);
        Route::get('/showByBooking/{booking_id}', [PaymentController::class, 'showByBooking']);
        Route::put('/{payment}', [PaymentController::class, 'update']);
        Route::put('/updateStatus/{payment}', [PaymentController::class, 'updateStatus']);
        Route::delete('/{payment}', [PaymentController::class, 'destroy']);
    });

    
});
