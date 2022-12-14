<?php

namespace App\Interfaces;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAll(string $search = null, $sort): LengthAwarePaginator;

    public function delete(Category $category): void;

    public function store(array $data): Category;

    public function update(Category $category, array $data): Category;

    public function getCategories(): Collection;
}
