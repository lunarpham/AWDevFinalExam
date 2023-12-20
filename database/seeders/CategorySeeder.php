<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public $categories = [
        [
            'id' => 1,
            'category' => 'College',
            'user_id' => 1,
            'color' => '#4478ab',
        ],
        [
            'id' => 2,
            'category' => 'Work',
            'user_id' => 1,
            'color' => '#78169D',
        ],
        [
            'id' => 3,
            'category' => 'Home',
            'user_id' => 1,
            'color' => '#78149D',
        ],
        [
            'id' => 4,
            'category' => 'Gaming',
            'user_id' => 2,
            'color' => '#58169D',
        ],
        [
            'id' => 5,
            'category' => 'Design',
            'user_id' => 2,
            'color' => '#52169D',
        ],
        [
            'id' => 6,
            'category' => 'Fitness',
            'user_id' => 2,
            'color' => '#4CAF50',
        ],
        [
            'id' => 7,
            'category' => 'Travel',
            'user_id' => 2,
            'color' => '#FFC107',
        ],
        [
            'id' => 8,
            'category' => 'Music',
            'user_id' => 3,
            'color' => '#FF5722',
        ],
        [
            'id' => 9,
            'category' => 'Reading',
            'user_id' => 3,
            'color' => '#795548',
        ],
        [
            'id' => 10,
            'category' => 'Coding',
            'user_id' => 3,
            'color' => '#607D8B',
        ],
    ];

    private function getCategories()
    {
        return $this->categories;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getCategories() as $category) {
            Category::create($category);
        }
    }
}
