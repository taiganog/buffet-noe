<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orcamento>
 */
class OrcamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->email(),
            'telefone' => $this->faker->numerify('(##) #####-####'),
            'tipo' => $this->faker->randomElement(['FESTA_INFANTIL',
                '15_ANOS',
                'FESTA_ADULTO',
                'CASAMENTO',
                'FORMATURA',
                'CONFRATERNIZACAO',
                'CHURRASCO']),
            'mensagem' => $this->faker->sentence(),
        ];
    }
}
