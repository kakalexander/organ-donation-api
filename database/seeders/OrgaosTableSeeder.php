<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrgaosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orgaos')->insert([
            [
                'user_id' => 1, 
                'nome_doador' => 'João Silva',
                'nome' => 'Coração',
                'descricao' => 'Órgão vital',
                'tipo' => 'Vital',
                'blood_type' => 'O+',
                'sexo' => 'M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, 
                'nome_doador' => 'Maria Oliveira',
                'nome' => 'Pulmões',
                'descricao' => 'Órgão vital',
                'tipo' => 'Vital',
                'blood_type' => 'A-',
                'sexo' => 'F',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
