<?php

namespace Database\Factories;

use App\Models\Solicitation;
use App\Models\Orgao;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitationFactory extends Factory
{
    protected $model = Solicitation::class;

    public function definition(): array
    {
        return [
            'orgao_id' => Orgao::factory(),
            'user_id' => User::factory(),
            'prazo' => $this->faker->numberBetween(1, 30) . ' dias', 
            'tipo_sanguineo' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'NÃO SEI']),
            'mensagem' => $this->faker->text(500),
        ];
    }
}

