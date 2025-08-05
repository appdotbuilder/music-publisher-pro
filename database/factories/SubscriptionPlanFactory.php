<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPlan>
 */
class SubscriptionPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(),
            'price_monthly' => $this->faker->randomFloat(2, 0, 299),
            'price_yearly' => $this->faker->randomFloat(2, 0, 2990),
            'features' => $this->faker->words(5),
            'max_artists' => $this->faker->numberBetween(1, 100),
            'max_tracks' => $this->faker->numberBetween(10, 1000),
            'is_active' => true,
        ];
    }
}