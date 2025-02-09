<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $isRegistered =fake()->boolean();

        if ($isRegistered){
            $registrationNumber = fake()->numberBetween(1, 9999);
        }
        else {
            $registrationNumber = null;
        }


        return [
            'name' => fake()->word(),
            'registration_number' => $registrationNumber,
            'is_registered' => $isRegistered
        ];
    }
}
