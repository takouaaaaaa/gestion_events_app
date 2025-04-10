<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categorie>
 */
class CategorieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $name = fake()->randomElement(['Poucet ', 'Poussin', 'Benjamin', 'Minime', 'Cadet', 'Junior', 'Senior']),
            'gender' => fake()->randomElement(['M', 'F']),
            'weight' => $weight = fake()->randomElement(['-50', '-55', '-60', '-65', '-70', '-75', '-80', '-85', '-90', '-95', '-100', '+100']),
            'slug' => Str::slug($name . '-' . $weight),

        ];
    }
}
