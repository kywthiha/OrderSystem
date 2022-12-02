<?php

namespace App\Interfaces;

use App\Models\Item;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ItemRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator;

    public function delete(Item $item): void;

    public function store(array $data): Item;

    public function update(Item $subCategitemory, array $data): Item;

    public function show(Item $item): Item;
}
