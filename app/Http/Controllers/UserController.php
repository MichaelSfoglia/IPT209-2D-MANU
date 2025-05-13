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
            'email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name ' =>
        ]);
    }
}
