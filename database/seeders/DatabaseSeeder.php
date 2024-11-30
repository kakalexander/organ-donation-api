<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Chama o PerfisTableSeeder primeiro
        $this->call(PerfisTableSeeder::class);

        // Chama o seeder de hospitais
        $this->call(HospitalsTableSeeder::class);

        // Chama o seeder de usuários (inclui o administrador)
        $this->call(UserSeeder::class);
    }
}
