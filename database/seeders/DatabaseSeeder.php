<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'aronas@gmail.com',
            'role' => 'admin',
        ]);
        $user = User::factory()->create([
            'name' => 'Normal User',
            'email' => 'user@test.com',
            'role' => 'user',
        ]);

        $readonly = User::factory()->create([
            'name' => 'Read Only User',
            'email' => 'readonly@test.com',
            'role' => 'readonly',
        ]);

        Owner::factory(5)->create([
            'user_id' => $user->id,
        ])->each(function ($owner) {
            Car::factory(rand(1, 3))->create([
                'owner_id' => $owner->id,
            ]);
        });

        Owner::factory(5)->create([
            'user_id' => $readonly->id,
        ])->each(function ($owner) {
            Car::factory(rand(1, 3))->create([
                'owner_id' => $owner->id,
            ]);
        });
    }
}
