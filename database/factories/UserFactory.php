<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isAnunciante = fake()->boolean();

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'is_anunciante' => $isAnunciante,
            'is_admin' => false,
            'nome_corretora' => $isAnunciante ? fake()->company() : null,
            'cnpj_corretora' => $isAnunciante ? fake()->numerify('##.###.###/####-##') : null,
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}