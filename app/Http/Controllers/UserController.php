<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        $users = User::with('role', 'status')->get();

        return response()->json(['users' => $users]);
    }

    public function addUser(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function editUser(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users, email' . $id],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found!'], 404);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return response()->json(['message' => 'User successfully edited!', 'user' => $user]);
    }

    public function deleteUser($id){
        $user = User::find($id);

        if(!$user){
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User successfully deleted!']);
    }
}
