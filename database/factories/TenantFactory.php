<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company() . ' Records';
        
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'subdomain' => $this->faker->unique()->slug(),
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->paragraph(),
            'status' => 'active',
            'settings' => [],
        ];
    }
}