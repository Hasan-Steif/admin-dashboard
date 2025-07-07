<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'token' => $user->createToken('auth_token')->plainTextToken
        ], 201);
    }

    public function login(AuthLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
