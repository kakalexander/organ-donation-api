<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'address_id' => 'required|exists:addresses,id',
        'profile_id' => 'required|exists:profiles,id',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'address_id' => $validated['address_id'],
        'profile_id' => $validated['profile_id'],
    ]);

    return response()->json($user, 201);
}

}
