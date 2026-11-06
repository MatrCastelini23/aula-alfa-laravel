<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mesma seed do Faker = mesmos nomes/emails para todo o time
        fake()->seed(1234);

        User::factory()->admin()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
        ]);

        User::factory()->count(5)->create();
    }
}
