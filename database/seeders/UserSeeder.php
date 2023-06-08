<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'      => fake()->name(),
            'email'     => "admin@student.id",
        ]);

        User::factory(10)->create();
    }
}
