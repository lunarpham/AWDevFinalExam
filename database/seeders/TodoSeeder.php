<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TodoSeeder extends Seeder
{
    public function run(): void
    {
        // Get all existing users
        $users = User::all();

        // Seed todos for each user
        foreach ($users as $user) {
            // Get all categories belonging to the current user
            $categories = $user->categories;

            foreach ($categories as $category) {
                // Seed at least 3 todos for each category
                Todo::factory()->count(3)->create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
