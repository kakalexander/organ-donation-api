<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adicionar um administrador fixo
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'id_perfil' => 1, // Administrador
            'tipo_cadastro' => 'admin',
            'blood_type' => null,
        ]);

        $admin = User::create([
            'name' => 'Receptor',
            'email' => 'receptor@example.com',
            'password' => bcrypt('admin123'),
            'id_perfil' => 1, // Administrador
            'tipo_cadastro' => 'receptor',
            'blood_type' => null,
        ]);

        $admin = User::create([
            'name' => 'Doador',
            'email' => 'doador@example.com',
            'password' => bcrypt('admin123'),
            'id_perfil' => 1, // Administrador
            'tipo_cadastro' => 'doador',
            'blood_type' => null,
        ]);

        // Gerar um token para o administrador
        DB::table('user_tokens')->insert([
            'user_id' => $admin->id,
            'token' => Str::uuid()->toString(), // Gera um token único
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Gerar usuários aleatórios (doador e receptor)
        User::factory(10)->create()->each(function ($user) {
            DB::table('user_tokens')->insert([
                'user_id' => $user->id,
                'token' => Str::uuid()->toString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
