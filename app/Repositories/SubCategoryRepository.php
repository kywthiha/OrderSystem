<?php

namespace App\Repositories;

use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\SubCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator
    {
        return SubCategory::query()
            ->with(['created_by:id,name', 'category:id,name'])
            ->search($search)
            ->filter($filter)
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

    public function show(SubCategory $subCategory): SubCategory
    {
        $subCategory->load(['created_by:id,name', 'updated_by:id,name', 'category:id,name']);
        return $subCategory;
    }

    public function getSubCategories(): Collection
    {
        return SubCategory::query()->select("id", "name", "category_id")->orderBy('name')->get();
    }
}
