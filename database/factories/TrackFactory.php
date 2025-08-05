<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => Tenant::factory(),
            'album_id' => Album::factory(),
            'title' => $this->faker->words(3, true),
            'duration_seconds' => $this->faker->numberBetween(120, 360),
            'track_number' => $this->faker->numberBetween(1, 12),
            'genre' => $this->faker->randomElement(['Pop', 'Rock', 'Hip Hop', 'Electronic', 'Jazz', 'Classical']),
            'status' => $this->faker->randomElement(['draft', 'pending', 'distributed', 'failed']),
            'play_count' => $this->faker->numberBetween(0, 100000),
            'revenue' => $this->faker->randomFloat(4, 0, 10000),
        ];
    }
}