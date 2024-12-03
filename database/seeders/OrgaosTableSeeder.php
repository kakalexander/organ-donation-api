<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrgaosTableSeeder extends Seeder
{
    public function run(): void
    {
        // Criar usuários fictícios (doadores)
        $userIds = DB::table('users')->insertGetId([
            ['name' => 'João Silva', 'email' => 'joao@example.com', 'password' => bcrypt('password'), 'blood_type' => 'O+', 'tipo_cadastro' => 'doador', 'created_at' => now()],
            ['name' => 'Maria Oliveira', 'email' => 'maria@example.com', 'password' => bcrypt('password'), 'blood_type' => 'A-', 'tipo_cadastro' => 'doador', 'created_at' => now()],
        ]);

        // Criar órgãos
        $orgaoIds = DB::table('orgaos')->insertGetId([
            ['nome' => 'Coração', 'descricao' => 'Órgão vital', 'tipo' => 'Vital', 'tipo_sanguineo' => 'O+', 'sexo' => 'M', 'created_at' => now()],
            ['nome' => 'Pulmões', 'descricao' => 'Órgão vital', 'tipo' => 'Vital', 'tipo_sanguineo' => 'A-', 'sexo' => 'F', 'created_at' => now()],
        ]);

        // Vincular órgãos aos usuários na tabela pivot
        DB::table('usuarios_orgaos')->insert([
            ['id_user' => $userIds[0], 'id_orgao' => $orgaoIds[0], 'tipo' => 'Doador', 'created_at' => now()],
            ['id_user' => $userIds[1], 'id_orgao' => $orgaoIds[1], 'tipo' => 'Doador', 'created_at' => now()],
        ]);
    }
}
