<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function storeOrder(array $orderDetails): Order
    {
        DB::beginTransaction();
        try {
            $order = Order::create($orderDetails);
            $order->orderPacks()->attach($orderDetails['order_packs']);
            $order->promoCode()->update([
                'apply_count' => DB::raw('apply_count + 1'),
            ]);
            DB::commit();
            $order->load(['orderPacks', 'promoCode']);
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
