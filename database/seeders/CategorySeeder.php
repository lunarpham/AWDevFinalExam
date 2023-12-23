<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Get all existing users
        $users = User::all();

        // Seed 3 random categories for each user
        foreach ($users as $user) {
            Category::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
