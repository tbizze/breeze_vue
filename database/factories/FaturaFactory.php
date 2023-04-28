<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fatura>
 */
class FaturaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dt_venc' => $this->faker->dateTimeBetween($startDate='2023-01-01',$endDate='2023-01-31'),
            'dt_pgto'=> $this->faker->dateTimeBetween($startDate='2023-01-01',$endDate='2023-01-31'),
            'valor_pgto'=> $this->faker->randomNumber(4)*0.45,
            'notas'=> $this->faker->sentence(3),

            'fat_operadora_id'=> $this->faker->numberBetween(1,3),
        ];
    }
}
