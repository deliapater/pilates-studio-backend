<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Client\Request as ClientRequest;

// Public routes
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (ClientRequest $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
});