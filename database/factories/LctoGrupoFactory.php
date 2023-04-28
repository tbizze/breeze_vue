<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LctoGrupo>
 */
class LctoGrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique(true)->randomElement([
                'N. Sra. Apda.',
                'CDP',
                'CSMP',
                'Matriz',
                ]),
            'notas' => $this->faker->sentence(4),
        ];
    }
}
