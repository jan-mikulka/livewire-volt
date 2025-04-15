<?php

namespace Database\Factories;

use Auth;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\ResourceType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => ResourceType::cases()[array_rand(ResourceType::cases())],
            'name' => fake()->name(),
            'url' => fake()->url(),
            'author' => fake()->name(),
        ];
    }

    /**
     * The Resource will belong to the authenticated user
     */
    public function own(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => Auth::id()
        ]);
    }
}
