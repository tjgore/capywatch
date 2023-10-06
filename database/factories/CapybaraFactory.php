<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Capybara>
 */
class CapybaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'hex_color' => fake()->hexColor(),
            'length_inches' => fake()->numberBetween(10, 40),
            'height_inches' => fake()->numberBetween(5, 20),
        ];
    }
}
