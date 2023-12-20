<?php

namespace App\Livewire;

use App\Repo\CategoryRepo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Category extends Component
{
    protected $categoryRepo;

    #[Rule('required|min:3')] public $category = '';
    public $color = '';

    public function boot(CategoryRepo $categoryRepo) {
        $this->categoryRepo = $categoryRepo;
    }

    public function addCategory() {
        $validatedCategory = $this->validate([
            'category' => 'required|min:3',
            'color' => 'required'
        ]);
        $this->categoryRepo->saveCategory($validatedCategory);
        $this->category = '';
        $this->color = '#ff0000';
    }

    public function render()
    {
        $categories = $this->categoryRepo->fetchAllCategories();
        return view('livewire.category', compact('categories'));
    }

}
