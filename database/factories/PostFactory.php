<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween($min = 1, $max = 8),
            'category_id' => fake()->numberBetween($min = 1, $max = 4),
            'title' => fake()->name(),
            'content' => fake()->sentence(400),
            'image' => 'images/olwxy9X7F57d8tqyT5NiAEa9jx66js2XnO6I1OdI.jpg',
            'status' => fake()->boolean(),
        ];
    }
}
