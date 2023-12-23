<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //random existed user id
        $userId = User::inRandomOrder()->first()->id;
        //random category_id that belongs to user_id
        $categoryId = Category::where('user_id', $userId)->inRandomOrder()->first()->id;
        return [
            'user_id' => $userId,
            'todo' => fake()->sentence(),
            'is_completed' => fake()->boolean(),
            'category_id' => $categoryId,
        ];
    }
}
