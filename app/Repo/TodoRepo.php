<?php

namespace App\Repo;

use PhpOption\None;

class TodoRepo {
    public function save($data) {
        $createTodo = auth()->user()->todos()->create($data);
        if ($createTodo) {
            return $createTodo;
        }
    }

    public function getTodo($todoId) {
        return auth()->user()->todos()->find($todoId);
    }

    public function fetchAll() {
        $todos = auth()->user()->todos()->latest()->paginate();
        return $todos;
    }

    public function fetchByCategory($selectedCategory) {
        $filterdTodos = auth()->user()->todos()->latest()->where('category_id', $selectedCategory)->paginate();
        return $filterdTodos;
    }

    public function update($todoId, $editedTodo, $editedCategory) {
        $todo = $this->getTodo($todoId);
        return $todo->update([ 'todo' => $editedTodo, 'category_id' => $editedCategory ]);
    }

    public function completed($todoId) {
        $todo = $this->getTodo($todoId);
        return ($todo->is_completed) ? $todo->update(['is_completed' => false]) : $todo->update(['is_completed' => true]);
    }

    public function delete($todoId) {
        return $this->getTodo($todoId)->delete();
    }
}