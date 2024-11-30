<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PerfisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('perfis')->insert([
            ['descricao' => 'Administrador'],
            ['descricao' => 'Receptor'],
            ['descricao' => 'Doador'],
        ]);
    }
    
}
