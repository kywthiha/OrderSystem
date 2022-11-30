<?php

namespace App\Interfaces;

use App\Models\Pack;

interface PackRepositoryInterface
{
    public function getAll(): array;
    public function getDetailByPack(Pack $pack): Pack;
    public function getSubTotalByPackIds(array $order_packs): float;
}
