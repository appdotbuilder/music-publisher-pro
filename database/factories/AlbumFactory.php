<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
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
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'release_date' => $this->faker->date(),
            'genre' => $this->faker->randomElement(['Pop', 'Rock', 'Hip Hop', 'Electronic', 'Jazz', 'Classical']),
            'label' => $this->faker->company() . ' Records',
            'status' => $this->faker->randomElement(['draft', 'pending', 'distributed', 'failed']),
        ];
    }
}