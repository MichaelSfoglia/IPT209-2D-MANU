<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'integer'],
            'role' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role' => $request->role, // User
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'User created successfully!', 'user' => $user]);
    }

    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'User logged in successfully!', 'user' => $user, 'token' => $token]);
    }
    
    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'User logged out successfully!']);
    }
}
