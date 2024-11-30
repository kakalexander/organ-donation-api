<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Endereco;
use App\Models\Orgao;
use App\Models\Solicitation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Chama o PerfisTableSeeder primeiro
        $this->call(PerfisTableSeeder::class);

        // Chama o seeder de hospitais
        $this->call(HospitalsTableSeeder::class);

        // Cria órgãos
        $orgaos = Orgao::factory()->count(10)->create(); // Cria 10 órgãos fictícios

        // Cria endereços
        $enderecos = Endereco::factory()->count(5)->create();

        // Use os IDs dos perfis para criar usuários
        $perfilIds = DB::table('perfis')->pluck('id')->toArray();

        // Criação de usuários
        $usuarios = [];
        foreach ($enderecos as $index => $endereco) {
            $usuarios[] = User::factory()->create([
                'name' => "User {$index}",
                'email' => "user{$index}@example.com",
                'id_endereco' => $endereco->id,
                'id_perfil' => $perfilIds[array_rand($perfilIds)],
            ]);
        }

        // Cria solicitações com usuários e órgãos existentes
        foreach ($usuarios as $usuario) {
            Solicitation::factory()->count(3)->create([
                'user_id' => $usuario->id,
                'orgao_id' => $orgaos->random()->id, 
            ]);
        }
    }
}
