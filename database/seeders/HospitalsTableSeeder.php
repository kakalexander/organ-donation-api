<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hospitals')->insert([
            [
                'name' => 'Hospital Geral de Teste',
                'address' => 'Rua Principal, 123 - Centro',
                'phone' => '62912345678',
            ],
            [
                'name' => 'Hospital do Coração',
                'address' => 'Avenida Saúde, 456 - Jardim Esperança',
                'phone' => '62987654321',
            ],
            [
                'name' => 'Hospital Infantil',
                'address' => 'Rua das Crianças, 789 - Bairro Feliz',
                'phone' => '62911223344',
            ],
        ]);
    }
}

