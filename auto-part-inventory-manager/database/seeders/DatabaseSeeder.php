<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
use App\Models\Part;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'id' => 1,
            'name' => 'admin@admin.com',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com')
        ]);

        Car::factory(10)
        ->has(Part::factory()->count(fake()->numberBetween(3, 5)))
        ->create();
    }
}
