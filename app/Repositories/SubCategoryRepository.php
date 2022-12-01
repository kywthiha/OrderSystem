<?php

namespace App\Repositories;

use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function getAll(string $search = null, $sort): LengthAwarePaginator
    {
        return SubCategory::query()
            ->with(['created_by:id,name', 'category:id,name'])
            ->search($search)
            ->order($sort)
            ->paginate(10);
    }

    public function delete(SubCategory $subCategory): void
    {
        $subCategory->delete();
    }

    public function store(array $data): SubCategory
    {
        return SubCategory::query()->create($data);
    }

    public function update(SubCategory $subCategory, array $data): SubCategory
    {
        $subCategory->update($data);
        return $subCategory;
    }

    public function getCategories(): Collection
    {
        return Category::query()->select("id", "name")->orderBy('name')->get();
    }

    public function show(SubCategory $subCategory): SubCategory
    {
        $subCategory->load(['created_by:id,name', 'updated_by:id,name', 'category:id,name']);
        return $subCategory;
    }
}
