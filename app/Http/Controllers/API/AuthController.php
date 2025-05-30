<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse // Configure return type
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'sometimes|string|in:user,admin',
        ]);

        // Create user, using model
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user',
        ]);

        // Return response
        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse // Configure return type
    {
        // Validate reuest
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Get User from table
        $user = User::where('email', $request->email)->first();

        // Check user credentials, using hash decrypting password
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        // Generate new token on each login
        $user->api_token = Str::random(60); // Add random 60 words.
        $user->save();

        // Returning data
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'api_token' => $user->api_token,
        ]);
    }
}
