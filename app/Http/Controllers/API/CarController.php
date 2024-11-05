<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // $cars = Car::all();
        $cars = Car::where('status', 'available')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Cars retrieved successfully',
            'data' => $cars
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
            'name' => 'required|string|max:255',
            'image' => 'required|string|max:255|mimes:png,jpg,jpeg',
            'brand' => 'required|string|max:255',
            'year' => 'required|integer',
            'type' => 'required|string|max:255',
            'fuel' => 'required|string|max:255',
            'transmission' => 'required|string|max:255',
            'seat' => 'required|integer',
            'license_plate' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('cars'), $imageName);
            $validated['image'] = $imageName;
        }

        $car = Car::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Car created successfully',
            'data' => $car
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Car $car)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Car retrieved successfully',
            'data' => $car
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'image' => 'string|max:255|mimes:png,jpg,jpeg',
            'brand' => 'string|max:255',
            'year' => 'integer',
            'type' => 'string|max:255',
            'fuel' => 'string|max:255',
            'transmission' => 'string|max:255',
            'seat' => 'integer',
            'license_plate' => 'string|max:255',
            'price' => 'numeric',
            'status' => 'string|in:available,rented,maintenance',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('cars'), $imageName);
            $validated['image'] = $imageName;
        }

        $car->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Car updated successfully',
            'data' => $car
        ], Response::HTTP_OK);
    }

    /**
     * Update status of the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, Car $car)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:available,rented,maintenance',
        ]);

        $car->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Car status updated successfully',
            'data' => $car
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Car deleted successfully'
        ], Response::HTTP_OK);
    }
}
