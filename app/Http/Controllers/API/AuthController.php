<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $accessToken = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'access_token' => $accessToken,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 401);
        }

        try {
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            return response()->json([
                'success' => true,
                'user' => $user
            ], 201);

        } catch (Exception $e) {
            $response = ['status' => 500, 'message' => $e];
            return response()->json($response);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            /** @var \App\Models\User $user **/
            $user = Auth::user()->currentAccessToken()->delete();
            return response()->json([
                'success' => true,
                'message' => 'Logout successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unable to Logout',
            ], 400);
        }
    }

    public function user()
    {
        return response()->json([
            'success' => true,
            'data' => Auth::user(),
        ], 200);
    }
}
