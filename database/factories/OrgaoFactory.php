<?php

namespace Database\Factories;

use App\Models\Orgao;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgaoFactory extends Factory
{
    protected $model = Orgao::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->word(), // Nome fictício para o órgão
            'descricao' => $this->faker->sentence(), // Uma breve descrição
            'tipo' => $this->faker->randomElement(['Vital', 'Não Vital']), // Tipo do órgão
            'tipo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', null]), // Tipo sanguíneo
            'sexo' => $this->faker->randomElement(['M', 'F', 'Outro', null]), // Sexo
        ];
    }
}
