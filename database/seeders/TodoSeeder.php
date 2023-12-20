<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TodoSeeder extends Seeder
{
    
    public $todos = [
        [
            'id' => 1,
            'user_id' => 2,
            'category_id' => 4,
            'todo' => 'Walking',
            'is_completed' => true,
        ],
        [
            'id' => 2,
            'user_id' => 2,
            'category_id' => 5,
            'todo' => 'JavaScript',
            'is_completed' => true,
        ],
        [
            'id' => 3,
            'user_id' => 2,
            'category_id' => 5,
            'todo' => 'Laravel',
            'is_completed' => false,
        ],
        [
            'id' => 4,
            'user_id' => 2,
            'category_id' => 6,
            'todo' => 'Node',
            'is_completed' => false,
        ],
        [
            'id' => 5,
            'user_id' => 1,
            'category_id' => 7,
            'todo' => 'React',
            'is_completed' => false,
        ],
        [
            'id' => 6,
            'user_id' => 2,
            'category_id' => 7,
            'todo' => 'Waling',
            'is_completed' => true,
        ],
        [
            'id' => 7,
            'user_id' => 2,
            'category_id' => null,
            'todo' => 'Waling',
            'is_completed' => false,
        ],
        [
            'id' => 8,
            'user_id' => 2,
            'category_id' => 5,
            'todo' => 'Waling',
            'is_completed' => true,
        ],
        [
            'id' => 9,
            'user_id' => 2,
            'category_id' => null,
            'todo' => 'Waling',
            'is_completed' => false,
        ],
        [
            'id' => 10,
            'user_id' => 1,
            'category_id' => null,
            'todo' => 'Waling',
            'is_completed' => true,
        ],
        [
            'id' => 11,
            'user_id' => 2,
            'category_id' => 7,
            'todo' => 'Waling',
            'is_completed' => false,
        ],
        [
            'id' => 12,
            'user_id' => 2,
            'category_id' => 4,
            'todo' => 'Waling',
            'is_completed' => false,
        ],
    ];

    private function getTodos()
    {
        return collect($this->todos);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getTodos() as $todo) {

            Todo::create($todo);
        }
    }
}
