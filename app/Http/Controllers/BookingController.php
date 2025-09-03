<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request) {
        return $request->user()->bookins->with('class')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'class_id' => 'required|exists:classes,id'
        ]);

        $user = $request->user();

        if($user->bookings()->where('class_id', $request->class_id)->exists()) {
            return response()->json(['message' => 'Already booked'], 409);
        }

        $booking = $user->bookings()->create([
            'class_id' => $request->class_id
        ]);

        return response()->json($booking, 201);
    }
}
