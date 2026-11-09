<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type' => 'user',
            'description' => 'Usuário comum',
            'user_id' => User::factory(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'type' => 'admin',
            'description' => 'Administrador de demonstração',
        ]);
    }
}
