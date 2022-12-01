<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(string $search = null, $sort): LengthAwarePaginator
    {
        return Category::query()
            ->with(['created_by:id,name'])
            ->search($search)
            ->order($sort)
            ->paginate(10);
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }

    public function store(array $data): Category
    {
        return Category::query()->create($data);
    }

    public function update(Category $category,array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function getCategories(): Collection
    {
        return Category::query()->select("id", "name")->orderBy('name')->get();
    }
}

