<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * Register a new user.
     */
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'blood_type' => $data['blood_type'] ?? null,
            'birth_date' => $data['birth_date'] ?? null,
            'id_perfil' => $data['id_perfil'] ?? 2, // Default: Receptor
        ]);
    }

    /**
     * Login user and generate token.
     */
    public function login(array $credentials): string
    {
        if (!Auth::attempt($credentials)) {
            throw new \Exception('Credenciais inválidas.', 401);
        }

        $user = Auth::user();

        // Generate a unique token
        $token = Str::uuid()->toString();

        // Save or update the token for the user
        UserToken::updateOrCreate(
            ['user_id' => $user->id],
            ['token' => $token]
        );

        return $token;
    }
}
