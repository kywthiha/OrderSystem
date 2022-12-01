<?php

namespace App\Interfaces;

use App\Models\SubCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SubCategoryRepositoryInterface
{
    public function getAll(string $search = null, $sort): LengthAwarePaginator;

    public function delete(SubCategory $subCategory): void;

    public function store(array $data): SubCategory;

    public function update(SubCategory $subCategory, array $data): SubCategory;

    public function show(SubCategory $subCategory): SubCategory;
}