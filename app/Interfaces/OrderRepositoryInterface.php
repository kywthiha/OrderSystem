<?php

namespace App\Interfaces;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function storeOrder(array $orderDetails): Order;
}
