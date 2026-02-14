<?php

namespace App\Interfaces;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function find(int $id): ?Category;

    public function create(array $data): Category;
}
