<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //random existed user_id
        $userId = User::inRandomOrder()->first()->id;
        return [
            'user_id' => $userId,
            'category' => fake()->streetAddress(),
            'color' => fake()->hexColor(),
        ];
    }
}
