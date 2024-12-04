<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'birth_date' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            'tipo_cadastro' => 'required|in:doador,receptor,admin',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-,NÃO SEI',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'birth_date' => $validated['birth_date'],
            'password' => Hash::make($validated['password']),
            'tipo_cadastro' => $validated['tipo_cadastro'],
            'blood_type' => $validated['blood_type'],
        ]);

        return response()->json(['message' => 'Usuário cadastrado com sucesso!', 'user' => $user], 201);
    }
}
