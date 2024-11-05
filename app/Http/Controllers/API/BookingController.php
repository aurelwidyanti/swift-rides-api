<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $bookings = Booking::with('user', 'car', 'address')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Bookings retrieved successfully',
            'data' => $bookings
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'user_id' => 'required|integer|exists:users,id',
            'car_id' => 'required|integer|exists:cars,id',
            'address_id' => 'required|integer|exists:addresses,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'string|in:pending,confirmed,canceled,completed',
        ]);

        // Check if car is available
        $car = Car::find($validated['car_id']);
        if ($car->status !== 'available') {
            return response()->json([
                'status' => 'error',
                'message' => 'Car is not available for booking'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Total price calculation
        $start_date = strtotime($validated['start_date']);
        $end_date = strtotime($validated['end_date']);
        $days = ($end_date - $start_date) / (60 * 60 * 24);
        $total_price = $days * $car->price;
        $validated['total_price'] = $total_price;

        if (!$validated['user_id'] = Auth::user()->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized user'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $newBooking = Booking::create($validated);

        $booking = Booking::with('user', 'car', 'address')->find($newBooking->id);

        // Update car status to rented
        $car->update(['status' => 'rented']);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking created successfully',
            'data' => $booking
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Booking $booking)
    {
        $booking->load('user', 'car', 'address');

        return response()->json([
            'status' => 'success',
            'message' => 'Booking retrieved successfully',
            'data' => $booking
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource by user id.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function bookingsByUser()
    {
        $booking = Booking::with('user', 'car', 'address')->where('user_id', Auth::user()->id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Booking retrieved successfully',
            'data' => $booking
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'integer|exists:users,id',
            'car_id' => 'integer|exists:cars,id',
            'address_id' => 'integer|exists:addresses,id',
            'start_date' => 'date',
            'end_date' => 'date',
            'status' => 'string|in:pending,confirmed,canceled,completed',
        ]);

        // Check if car is available
        if (isset($validated['car_id'])) {
            $car = Car::find($validated['car_id']);
            if ($car->status !== 'available') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Car is not available for booking'
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        // Total price calculation
        if (isset($validated['start_date']) && isset($validated['end_date'])) {
            $start_date = strtotime($validated['start_date']);
            $end_date = strtotime($validated['end_date']);
            $days = ($end_date - $start_date) / (60 * 60 * 24);
            $total_price = $days * $car->price;
            $validated['total_price'] = $total_price;
        }

        $booking->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking updated successfully',
            'data' => $booking
        ], Response::HTTP_OK);
    }

    /**
     * Update status of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,canceled,completed',
        ]);

        $booking->update($validated);

        // Update car status to available if booking is canceled or completed
        if ($validated['status'] === 'canceled' || $validated['status'] === 'completed') {
            $booking->car->update(['status' => 'available']);
        } else {
            $booking->car->update(['status' => 'rented']);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Booking status updated successfully',
            'data' => $booking
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Booking deleted successfully'
        ], Response::HTTP_OK);
    }
}
