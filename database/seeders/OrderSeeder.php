<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $items = Item::query()->take(10)->get();
        $user = User::query()->isUser()->first();
        foreach ($items as $item) {
            $orderItems = $items->shuffle()->take(rand(2, 5));
            $attachItems = [];
            $total_amount = 0;
            foreach ($orderItems as $orderItem) {
                $qty = rand(1, 5);
                $total_amount += $orderItem->price * $qty;
                $attachItems[$orderItem->id] = [
                    'price' => $orderItem->price,
                    'quantity' => $qty
                ];
            }
            $order = Order::factory([
                "user_id" => $user->id,
                'total_amount' => $total_amount,
            ])->create();
            $order->items()->attach($attachItems);
        }
    }
}
