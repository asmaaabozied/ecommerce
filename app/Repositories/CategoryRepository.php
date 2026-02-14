<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
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
