<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Adicionar um administrador fixo
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'id_perfil' => 1, // Administrador
            'tipo_cadastro' => 'admin',
            'blood_type' => null,
        ]);

        // Gerar usuários aleatórios (doador e receptor)
        User::factory(10)->create();
    }
}
