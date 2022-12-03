<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function store(array $data, array $orderItems): Order
    {
        DB::beginTransaction();
        try {
            $items = Item::query()->whereIn('id', array_keys($orderItems))->get()->map(function (Item $item) use ($orderItems) {
                $item->quantity = $orderItems[$item->id]['quantity'];
                return $item;
            });
            $total_amount = 0;
            $attachItems = [];
            foreach ($items as $orderItem) {
                $total_amount += $orderItem->price * $orderItem->quantity;
                $attachItems[$orderItem->id] = [
                    'price' => $orderItem->price,
                    'quantity' => $orderItem->quantity
                ];
            }
            $order = Order::query()->create([
                'total_amount' => $total_amount,
            ] + $data);
            $order->items()->attach($attachItems);
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
