<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mesma seed do Faker = mesmos nomes/emails para todo o time
        fake()->seed(1234);

        // 1 administrador (perfil type = admin)
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
        ]);
        Profile::factory()->admin()->for($admin)->create();

        // 5 usuários comuns (perfil type = user)
        User::factory()
            ->count(5)
            ->has(Profile::factory(), 'profile')
            ->create();
    }
}
