<?php

namespace App\Livewire;

use App\Repo\TodoRepo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Todo extends Component
{
    protected $repo;
    #[Rule('required|min:3')]   //Required at least 3 character to create a task
    public $todo = '';
    #[Rule('required|min:3')]
    public $editedTodo;
    public $edit;

    public function boot(TodoRepo $repo) {
        $this->repo = $repo;
    }

    public function addTodo() {
        $validated = $this->validateOnly('todo');
        $this->repo->save($validated);
        $this->todo = '';
    }

    public function editTodo($todoId) {
        $this->edit = $todoId;
        $this->editedTodo = $this->repo->getTodo($todoId)->todo;
    }

    public function updateTodo($todoId) {
        $validated = $this->validateOnly('editedTodo');
        $this->repo->update($todoId, $validated['editedTodo']);
        $this->cancelEdit();
    }

    public function cancelEdit() {
        $this->edit = '';
    }

    public function deleteTodo($todoId) {
        $this->repo->delete($todoId);
    }
    
    public function markCompleted($todoId) {
        return $this->repo->completed($todoId);
    }

    public function render()
    {
        $todos = $this->repo->fetchAll();
        return view('livewire.todo', compact('todos'));
    }

}
