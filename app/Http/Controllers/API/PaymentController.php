<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $payments = Payment::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Payments retrieved successfully',
            'data' => $payments
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
            'booking_id' => 'required|integer|exists:bookings,id',
            'amount' => 'required|numeric',
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        $payment = Payment::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment created successfully',
            'data' => $payment
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Payment $payment)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Payment retrieved successfully',
            'data' => $payment
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource by booking id.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function showByBooking($booking_id)
    {
        $payment = Payment::where('booking_id', $booking_id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment retrieved successfully',
            'data' => $payment
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'booking_id' => 'integer|exists:bookings,id',
            'amount' => 'numeric',
            'status' => 'string|in:pending,completed,failed',
        ]);

        $payment->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment updated successfully',
            'data' => $payment
        ], Response::HTTP_OK);
    }

    /**
     * Update status of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,completed,failed',
        ]);

        if ($validated['status'] === 'completed') {
            $validated['payment_date'] = now();
        } else {
            $validated['payment_date'] = null;
        }

        $payment->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Payment status updated successfully',
            'data' => $payment
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Payment deleted successfully'
        ], Response::HTTP_OK);
    }
}
