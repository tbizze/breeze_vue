<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FaturaItem>
 */
class FaturaItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dt_compra' => $this->faker->dateTimeBetween($startDate='2023-01-01',$endDate='2023-01-31'),
            'historico'=> $this->faker->sentence(4),
            'parcelas'=> $this->faker->numberBetween(0,8),
            'valor_compra'=> $this->faker->randomNumber(4)*0.45,
            'notas'=> $this->faker->sentence(3),

            'fat_grupo_id'=> $this->faker->numberBetween(1,4),
            'fatura_id'=> $this->faker->numberBetween(1,10),
        ];
    }
}
