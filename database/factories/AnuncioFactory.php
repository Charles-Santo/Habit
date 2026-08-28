<?php

namespace Database\Factories;

use App\Models\Anuncio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Anuncio>
 */
class AnuncioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->streetName() . ' - ' . fake()->randomElement(['Apartamento', 'Casa', 'Sala Comercial', 'Terreno']),
            'email' => fake()->safeEmail(),
            'preco' => fake()->randomFloat(2, 80000, 950000),
            'area' => fake()->randomFloat(2, 25, 350),
            'telefone' => fake()->numerify('(##) #####-####'),
            'descricao' => fake()->paragraph(),
        ];
    }
}
