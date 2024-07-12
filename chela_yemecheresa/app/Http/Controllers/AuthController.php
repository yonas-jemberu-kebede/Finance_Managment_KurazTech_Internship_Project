<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Register method called.');
    Log::info('Request data: ', $request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|string|in:admin,user,guest', // Example types
            'status' => 'required|string|in:active,inactive', // Example statuses
            'role' => 'required|string|max:255', // Role validation
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', // Profile picture validation
        ]);

        $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        $url=Storage::url($profilePicturePath);
    }else{
        $url=null;
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_type' => $request->user_type,
        'status' => $request->status,
        
        'role' => $request->role,
        'profile_picture' => $url,
    ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,

    'message'=>'user created successfully'
], 201
);
Log::info('User creation attempted.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->status !== 'active') {
            throw ValidationException::withMessages([
                'email' => ['Your account is inactive.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token,'message'=>'user loged successfully'], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
