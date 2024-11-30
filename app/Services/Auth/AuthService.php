<?php

namespace App\Services\Auth ;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthService
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function login(array $credentials): ?string
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $token = Str::uuid()->toString();

            DB::table('user_tokens')->insert([
                'user_id' => $user->id,
                'token' => $token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return $token;
        }

        return null;
    }
}
