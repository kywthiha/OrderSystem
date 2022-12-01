<?php

namespace App\Interfaces;

use App\Models\SubCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SubCategoryRepositoryInterface
{
    public function getAll(string $search = null, $sort): LengthAwarePaginator;

    public function delete(SubCategory $subCategory): void;

    public function store(array $data): SubCategory;

    public function update(SubCategory $subCategory, array $data): SubCategory;

    public function getCategories(): Collection;

    public function show(SubCategory $subCategory): SubCategory;
}
