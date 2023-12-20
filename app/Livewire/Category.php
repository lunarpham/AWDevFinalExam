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

    #[Rule('required|min:3')] public $editedCategory;
    public $editCategory;

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

    public function editCategoryButton($cateId) {
        $this->editCategory = $cateId;
        $this->editedCategory = $this->categoryRepo->getCategory($cateId)->category;
    }

    public function updateCategoryButton($cateId) {
        $validatedCategory = $this->validateOnly('editedCategory');
        $this->categoryRepo->updateCategory($cateId, $validatedCategory['editedCategory']);
        $this->cancelCategoryEdit();
    }

    public function deleteCategoryButton($cateId) {
        $this->categoryRepo->deleteCategory($cateId);
    }

    public function cancelCategoryEdit() {
        $this->editCategory = '';
    }

    public function render()
    {
        $categories = $this->categoryRepo->fetchAllCategories();
        return view('livewire.category', compact('categories'));
    }

}
