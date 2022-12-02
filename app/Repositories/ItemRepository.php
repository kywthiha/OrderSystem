<?php

namespace App\Repositories;

use App\Interfaces\ItemRepositoryInterface;
use App\Models\Item;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ItemRepository implements ItemRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator
    {
        return Item::query()
            ->select('items.*', 'categories.name as category_name', 'sub_categories.name as sub_category_name', 'users.name as created_user_name')
            ->leftJoin('categories', 'categories.id', '=', 'items.category_id')
            ->leftJoin('sub_categories', 'sub_categories.id', '=', 'items.sub_category_id')
            ->leftJoin('users', 'users.id', '=', 'items.created_user')
            ->search($search)
            ->order($sort)
            ->filter($filter)
            ->whereNull('categories.deleted_at')
            ->whereNull('sub_categories.deleted_at')
            ->paginate(10);
    }

    public function delete(Item $item): void
    {
        $item->delete();
    }

    public function store(array $data): Item
    {
        return Item::query()->create($data);
    }

    public function update(Item $item, array $data): Item
    {
        $item->update($data);
        return $item;
    }

    public function show(Item $item): Item
    {
        $item->load(['created_by:id,name', 'updated_by:id,name', 'category:id,name', 'subCategory:id,name']);
        return $item;
    }
}
