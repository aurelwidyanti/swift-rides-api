<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $addresss = Address::all();

        return response()->json([
            'status' => 'success',
            'message' => 'Addresss retrieved successfully',
            'data' => $addresss
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
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'street' => 'required|string|max:255',
        ]);

        $address = Address::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Address created successfully',
            'data' => $address
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Address $address)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Address retrieved successfully',
            'data' => $address
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource by user id.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function addressesByUser()
    {
        $address = Address::where('user_id', Auth::user()->id)->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Address retrieved successfully',
            'data' => $address
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'user_id' => 'integer|exists:users,id',
            'title' => 'required|string|max:255',
            'city' => 'string|max:255',
            'street' => 'string|max:255',
        ]);

        $address->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Address updated successfully',
            'data' => $address
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Address deleted successfully'
        ], Response::HTTP_OK);
    }
}
