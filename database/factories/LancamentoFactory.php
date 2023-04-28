<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lancamento>
 */
class LancamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
/*         $lcto_tipo = $this->faker->randomElement(['D', 'C']);
        
        if($lcto_tipo = "D"){
            $lcto_valor = $this->faker->randomNumber(3)*-0.45;
        }elseif($lcto_tipo = "C"){
            $lcto_valor = $this->faker->randomNumber(3)*0.45;
        }; */

        return [
            'lcto_data' => $this->faker->dateTimeBetween($startDate='2023-01-01',$endDate='2023-01-31'),
            'lcto_historico'=> $this->faker->sentence(4),
            'lcto_tipo' => $this->faker->randomElement(['D', 'C']),
            'lcto_valor'=> $this->faker->randomNumber(4)*0.45,
            'lcto_notas'=> $this->faker->sentence,
            
            'lcto_grupo_id' => $this->faker->numberBetween(1, 4), 
            //'grupo_id' => $this->getRandom('Grupo')->id,
            //'grupo_id' => $this->faker->unique()->numberBetween(1, 3), // Usa valor entre 1 e 4.
        ];
    }
}
