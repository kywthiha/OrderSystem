<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator
    {
        return Order::query()
            ->select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->withCount('items')
            ->search($search)
            ->order($sort)
            ->filter($filter)
            ->paginate(10);
    }


    public function show(Order $order): Order
    {
        $order->load(['user:id,name', 'items']);
        return $order;
    }
}
