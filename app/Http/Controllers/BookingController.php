<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request) {
        return $request->user()
        ->bookings()
        ->with('class')
        ->get()
        ->map(function ($booking) {
            return [
                'booking_id' => $booking->id,
                'class_id' => $booking->class->id,
                'className' => $booking->class->className,
                'instructor' => $booking->class->instructor,
                'time' => $booking->class->time,
                'spots' => $booking->class->spots,
            ];
        });
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

        return response()->json($booking->load('class'), 201);
    }

    public function destroy(Request $request, $id) {
        $user = $request->user();

        $booking = $user->bookings()->where('id', $id)->first();
        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking->delete();
        return response()->json(['message' => 'Booking deleted'], 200);
    }
}
