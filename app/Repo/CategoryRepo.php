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

    public function fetchAllCategories() {
        $categories = auth()->user()->categories()->latest()->paginate();
        return $categories;
    }

}