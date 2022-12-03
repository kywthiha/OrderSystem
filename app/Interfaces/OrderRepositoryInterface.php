<?php

namespace App\Interfaces;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface
{
    public function getAll(string $search = null, $sort, $filter = null): LengthAwarePaginator;

    public function show(Order $order): Order;

    public function store(array $data, array $orderItems): Order;
}
