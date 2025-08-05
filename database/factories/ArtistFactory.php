<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
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
            'user_id' => User::factory(),
            'name' => $this->faker->name(),
            'stage_name' => $this->faker->userName(),
            'bio' => $this->faker->paragraph(),
            'country' => $this->faker->countryCode(),
            'genre' => $this->faker->randomElement(['Pop', 'Rock', 'Hip Hop', 'Electronic', 'Jazz', 'Classical']),
            'social_links' => [
                'instagram' => '@' . $this->faker->userName(),
                'twitter' => '@' . $this->faker->userName(),
            ],
            'is_active' => true,
        ];
    }
}