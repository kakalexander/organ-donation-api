<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrgaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orgaos')->insert([
            [
                'nome' => 'Coração',
                'descricao' => 'Órgão responsável por bombear o sangue pelo corpo.',
                'tipo' => 'Vital',
            ],
            [
                'nome' => 'Pulmões',
                'descricao' => 'Órgãos responsáveis pela troca de gases no organismo.',
                'tipo' => 'Vital',
            ],
            [
                'nome' => 'Fígado',
                'descricao' => 'Órgão responsável pelo metabolismo e detoxificação.',
                'tipo' => 'Vital',
            ],
            [
                'nome' => 'Rins',
                'descricao' => 'Órgãos que filtram o sangue e produzem urina.',
                'tipo' => 'Vital',
            ],
            [
                'nome' => 'Estômago',
                'descricao' => 'Órgão do sistema digestivo responsável pela digestão inicial dos alimentos.',
                'tipo' => 'Digestivo',
            ],
        ]);
    }
}
