<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Register a new user
    public function register(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'nullable|string|max:255', // Name is optional
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name ?? 'Default Name', // Provide a default name if not provided
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Return a success response
        return response()->json(['message' => 'User registered successfully!'], 201);
    }

    // Login and return authentication token
    public function login(Request $request)
    {
        // Validate incoming credentials
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            // Generate token for the authenticated user
            $token = $user->createToken('API Token')->plainTextToken;

            // Return success response with token
            return response()->json([
                'message' => 'Successful login',
                'token' => $token,
            ], 200);
        }

        // Throw validation exception if credentials are invalid
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
