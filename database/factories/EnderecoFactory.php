<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnderecoFactory extends Factory
{
    protected $model = \App\Models\Endereco::class;

    public function definition(): array
    {
        return [
            'rua' => $this->faker->streetAddress(),
            'cidade' => $this->faker->city(),
            'estado' => $this->faker->state(),
            'cep' => $this->faker->postcode(),
        ];
    }
}
