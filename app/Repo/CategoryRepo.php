<?php

namespace App\Repo;

use PhpOption\None;

class CategoryRepo {
    public function saveCategory($data) {
        $createCategory = auth()->user()->categories()->create($data);
        if ($createCategory) {
            return $createCategory;
        }
    }

    public function getCategory($cateId) {
        return auth()->user()->categories()->find($cateId);
    }

    public function updateCategory($cateId, $editedCategory) {
        $category = $this->getCategory($cateId);
        return $category->update([ 'category' => $editedCategory ]);
    }

    public function deleteCategory($cateId) {
        return $this->getCategory($cateId)->delete();
    }

    public function fetchAllCategories() {
        $categories = auth()->user()->categories()->latest()->paginate();
        return $categories;
    }

}