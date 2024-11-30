<?php

namespace Database\Factories;

use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;

    public function definition(): array
{
    // Busca um ID de perfil existente para usar
    $perfilId = DB::table('perfis')->inRandomOrder()->value('id');

    return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'password' => bcrypt('password'),
        'id_endereco' => Endereco::factory(), // Gera um endereço associado
        'id_perfil' => $perfilId, // Usa um ID de perfil existente
        'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'NÃO SEI']),
        'tipo_cadastro' => $this->faker->randomElement(['doador', 'receptor']),
    ];
}
}
