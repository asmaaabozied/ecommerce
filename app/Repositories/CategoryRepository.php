<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function find(int $id): ?Category
    {
        return Category::with('attributes')->find($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }
}
