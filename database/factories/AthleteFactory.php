<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Athlete>
 */
class AthleteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $firstName=$this->faker->firstName(),
            'last_name' => $lastName=$this->faker->lastName(),
            'gender' => $this->faker->randomElement(['M', 'F']),
            'birth_date' => $this->faker->date(),
            'slug' => Str::slug($firstName.'-'.$lastName),
        ];

    }
}
