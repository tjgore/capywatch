<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Capybara;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Observation>
 */
class ObservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $capybaraId = Capybara::inRandomOrder()->first()->id;
        $cityId = City::inRandomOrder()->first()->id;

        return [
            'capybara_id' => $capybaraId,
            'city_id' => $cityId,
            'has_hat' => fake()->randomElement([1, 0]),
            'observed_at' => Carbon::now()->subDays(fake()->unique()->numberBetween(1, 5000))->format('Y-m-d')
                
        ];
    }
}
