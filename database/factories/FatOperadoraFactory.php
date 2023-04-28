<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FatOperadora>
 */
class FatOperadoraFactory extends Factory
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
                'Santander',
                'Makro',
                'Credicard',
                ]),
            'notas' => $this->faker->sentence(4),
        ];
    }
}
